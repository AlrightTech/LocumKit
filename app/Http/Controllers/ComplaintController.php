<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    /**
     * Display a listing of complaints (Admin only)
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Complaint::class);
        
        $status = $request->get('status', 'all');
        $query = Complaint::with('assignedUser');
        
        if ($status !== 'all') {
            $query->byStatus($status);
        }
        
        $complaints = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.complaints.index', compact('complaints', 'status'));
    }

    /**
     * Show the form for creating a new complaint
     */
    public function create()
    {
        return view('contact'); // Use existing contact form
    }

    /**
     * Store a newly created complaint
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $complaint = Complaint::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => Complaint::STATUS_OPEN,
        ]);

        // Send notification to admins
        $this->notifyAdmins($complaint);

        return redirect()->route('contact')->with('success', 'Your complaint has been submitted successfully. We will review it and get back to you soon.');
    }

    /**
     * Display the specified complaint (Admin only)
     */
    public function show(Complaint $complaint)
    {
        $this->authorize('view', $complaint);
        
        $complaint->load('assignedUser');
        $admins = User::where('user_acl_role_id', User::USER_ROLE_ADMIN)->get();
        
        return view('admin.complaints.view', compact('complaint', 'admins'));
    }

    /**
     * Update the specified complaint (Admin only)
     */
    public function update(Request $request, Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'resolution_notes' => 'nullable|string',
        ]);

        $complaint->update([
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'resolution_notes' => $request->resolution_notes,
        ]);

        // If resolved, set resolved_at timestamp
        if ($request->status === Complaint::STATUS_RESOLVED && !$complaint->resolved_at) {
            $complaint->update(['resolved_at' => now()]);
        }

        // Send resolution email if status changed to resolved
        if ($request->status === Complaint::STATUS_RESOLVED) {
            $this->sendResolutionEmail($complaint);
        }

        return redirect()->route('admin.complaints.show', $complaint)->with('success', 'Complaint updated successfully.');
    }

    /**
     * Assign complaint to admin user
     */
    public function assign(Request $request, Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $complaint->assignTo($request->assigned_to);

        return redirect()->route('admin.complaints.show', $complaint)->with('success', 'Complaint assigned successfully.');
    }

    /**
     * Resolve complaint
     */
    public function resolve(Request $request, Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        
        $request->validate([
            'resolution_notes' => 'required|string',
        ]);

        $complaint->markAsResolved($request->resolution_notes);
        $this->sendResolutionEmail($complaint);

        return redirect()->route('admin.complaints.show', $complaint)->with('success', 'Complaint resolved successfully.');
    }

    /**
     * Close complaint
     */
    public function close(Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        
        $complaint->markAsClosed();

        return redirect()->route('admin.complaints.show', $complaint)->with('success', 'Complaint closed successfully.');
    }

    /**
     * Notify admins about new complaint
     */
    private function notifyAdmins(Complaint $complaint)
    {
        $admins = User::where('user_acl_role_id', User::USER_ROLE_ADMIN)->get();
        
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new \App\Mail\NewComplaintNotification($complaint));
        }
    }

    /**
     * Send resolution email to complainant
     */
    private function sendResolutionEmail(Complaint $complaint)
    {
        Mail::to($complaint->email)->send(new \App\Mail\ComplaintResolutionMail($complaint));
    }
}
