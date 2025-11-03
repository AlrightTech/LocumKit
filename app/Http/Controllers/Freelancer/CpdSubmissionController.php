<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\CpdSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CpdSubmissionController extends Controller
{
    /**
     * Display a listing of CPD submissions for the current user
     */
    public function index()
    {
        $user = Auth::user();
        $submissions = CpdSubmission::forUser($user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('freelancer.cpd.index', compact('submissions'));
    }

    /**
     * Show the form for creating a new CPD submission
     */
    public function create()
    {
        $user = Auth::user();
        
        // Calculate current cycle dates (every 3 months)
        $currentCycle = $this->getCurrentCycleDates();
        
        // Check if user already has a submission for current cycle
        $existingSubmission = CpdSubmission::forUser($user->id)
            ->where('cycle_start_date', $currentCycle['start'])
            ->where('cycle_end_date', $currentCycle['end'])
            ->first();

        if ($existingSubmission) {
            return redirect()->route('freelancer.cpd.show', $existingSubmission)
                ->with('info', 'You already have a CPD submission for the current cycle.');
        }

        return view('freelancer.cpd.create', compact('currentCycle'));
    }

    /**
     * Store a newly created CPD submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'cpd_points' => 'required|integer|min:1|max:100',
            'evidence_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            'submission_date' => 'required|date',
            'cycle_start_date' => 'required|date',
            'cycle_end_date' => 'required|date|after:cycle_start_date',
        ]);

        $user = Auth::user();
        
        // Handle file upload
        $file = $request->file('evidence_file');
        $fileName = 'cpd_evidence_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('cpd_evidence', $fileName, 'public');

        $submission = CpdSubmission::create([
            'user_id' => $user->id,
            'cpd_points' => $request->cpd_points,
            'evidence_file_path' => $filePath,
            'submission_date' => $request->submission_date,
            'cycle_start_date' => $request->cycle_start_date,
            'cycle_end_date' => $request->cycle_end_date,
            'status' => CpdSubmission::STATUS_PENDING,
        ]);

        // Send notification to admins
        $this->notifyAdmins($submission);

        return redirect()->route('freelancer.cpd.show', $submission)
            ->with('success', 'CPD submission created successfully. It will be reviewed by our team.');
    }

    /**
     * Display the specified CPD submission
     */
    public function show(CpdSubmission $cpdSubmission)
    {
        // Ensure user can only view their own submissions
        if ($cpdSubmission->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to CPD submission.');
        }

        return view('freelancer.cpd.show', compact('cpdSubmission'));
    }

    /**
     * Show the form for editing the specified CPD submission
     */
    public function edit(CpdSubmission $cpdSubmission)
    {
        // Ensure user can only edit their own submissions
        if ($cpdSubmission->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to CPD submission.');
        }

        // Only allow editing if status is pending
        if ($cpdSubmission->status !== CpdSubmission::STATUS_PENDING) {
            return redirect()->route('freelancer.cpd.show', $cpdSubmission)
                ->with('error', 'You can only edit pending submissions.');
        }

        return view('freelancer.cpd.edit', compact('cpdSubmission'));
    }

    /**
     * Update the specified CPD submission
     */
    public function update(Request $request, CpdSubmission $cpdSubmission)
    {
        // Ensure user can only update their own submissions
        if ($cpdSubmission->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to CPD submission.');
        }

        // Only allow updating if status is pending
        if ($cpdSubmission->status !== CpdSubmission::STATUS_PENDING) {
            return redirect()->route('freelancer.cpd.show', $cpdSubmission)
                ->with('error', 'You can only edit pending submissions.');
        }

        $request->validate([
            'cpd_points' => 'required|integer|min:1|max:100',
            'evidence_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'submission_date' => 'required|date',
        ]);

        $data = [
            'cpd_points' => $request->cpd_points,
            'submission_date' => $request->submission_date,
        ];

        // Handle file upload if new file is provided
        if ($request->hasFile('evidence_file')) {
            // Delete old file
            if ($cpdSubmission->evidence_file_path) {
                Storage::disk('public')->delete($cpdSubmission->evidence_file_path);
            }

            $file = $request->file('evidence_file');
            $fileName = 'cpd_evidence_' . $cpdSubmission->user_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('cpd_evidence', $fileName, 'public');
            $data['evidence_file_path'] = $filePath;
        }

        $cpdSubmission->update($data);

        return redirect()->route('freelancer.cpd.show', $cpdSubmission)
            ->with('success', 'CPD submission updated successfully.');
    }

    /**
     * Get current cycle dates (every 3 months)
     */
    private function getCurrentCycleDates()
    {
        $now = now();
        $currentMonth = $now->month;
        
        // Calculate cycle start based on current month
        if ($currentMonth <= 3) {
            $cycleStart = $now->copy()->startOfYear();
            $cycleEnd = $now->copy()->startOfYear()->addMonths(3)->subDay();
        } elseif ($currentMonth <= 6) {
            $cycleStart = $now->copy()->startOfYear()->addMonths(3);
            $cycleEnd = $now->copy()->startOfYear()->addMonths(6)->subDay();
        } elseif ($currentMonth <= 9) {
            $cycleStart = $now->copy()->startOfYear()->addMonths(6);
            $cycleEnd = $now->copy()->startOfYear()->addMonths(9)->subDay();
        } else {
            $cycleStart = $now->copy()->startOfYear()->addMonths(9);
            $cycleEnd = $now->copy()->startOfYear()->addMonths(12)->subDay();
        }

        return [
            'start' => $cycleStart->format('Y-m-d'),
            'end' => $cycleEnd->format('Y-m-d'),
        ];
    }

    /**
     * Notify admins about new CPD submission
     */
    private function notifyAdmins(CpdSubmission $submission)
    {
        $admins = User::where('user_acl_role_id', User::USER_ROLE_ADMIN)->get();
        
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new \App\Mail\CpdSubmissionNotification($submission));
        }
    }
}
