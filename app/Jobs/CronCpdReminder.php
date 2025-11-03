<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\CpdSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CronCpdReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get all freelancers (locums)
        $freelancers = User::where('user_acl_role_id', User::USER_ROLE_LOCUM)
            ->where('active', User::USER_STATUS_ACTIVE)
            ->get();

        foreach ($freelancers as $freelancer) {
            $this->checkAndSendCpdReminder($freelancer);
        }
    }

    /**
     * Check if freelancer needs CPD reminder and send if necessary
     */
    private function checkAndSendCpdReminder(User $freelancer)
    {
        // Calculate current cycle dates (every 3 months)
        $currentCycle = $this->getCurrentCycleDates();
        
        // Check if freelancer has submitted CPD for current cycle
        $existingSubmission = CpdSubmission::forUser($freelancer->id)
            ->where('cycle_start_date', $currentCycle['start'])
            ->where('cycle_end_date', $currentCycle['end'])
            ->first();

        // If no submission exists and we're in the last month of the cycle, send reminder
        if (!$existingSubmission) {
            $cycleEnd = \Carbon\Carbon::parse($currentCycle['end']);
            $daysUntilEnd = now()->diffInDays($cycleEnd, false);
            
            // Send reminder if we're within 30 days of cycle end
            if ($daysUntilEnd <= 30 && $daysUntilEnd >= 0) {
                $this->sendCpdReminder($freelancer, $currentCycle, $daysUntilEnd);
            }
        }
    }

    /**
     * Send CPD reminder email to freelancer
     */
    private function sendCpdReminder(User $freelancer, array $currentCycle, int $daysUntilEnd)
    {
        try {
            Mail::to($freelancer->email)->send(new \App\Mail\CpdReminderMail($freelancer, $currentCycle, $daysUntilEnd));
        } catch (\Exception $e) {
            \Log::error('Failed to send CPD reminder to freelancer ' . $freelancer->id . ': ' . $e->getMessage());
        }
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
}
