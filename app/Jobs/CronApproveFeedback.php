<?php

namespace App\Jobs;

use App\Models\JobFeedback;
use App\Models\JobFeedbackDispute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CronApproveFeedback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::channel('queue-worker')->info('CronApproveFeedback is working');
        
        // Get feedback that is pending and older than 48 hours
        $pendingFeedbacks = JobFeedback::where("status", 0)
            ->where("created_at", "<=", now()->subHours(48))
            ->get();

        foreach ($pendingFeedbacks as $feedback) {
            // Check if there are any disputes for this feedback
            $hasDispute = JobFeedbackDispute::where('job_feedback_id', $feedback->id)->exists();
            
            if (!$hasDispute) {
                // Auto-approve the feedback
                $feedback->update(['status' => 1]);
                
                // Send notification to both parties
                $this->sendFeedbackApprovedNotification($feedback);
                
                Log::channel('queue-worker')->info("Auto-approved feedback ID: {$feedback->id}");
            } else {
                Log::channel('queue-worker')->info("Feedback ID: {$feedback->id} has disputes, skipping auto-approval");
            }
        }
    }

    /**
     * Send notification when feedback is auto-approved
     */
    private function sendFeedbackApprovedNotification(JobFeedback $feedback)
    {
        try {
            // Get the job and users involved
            $job = $feedback->job;
            $feedbackBy = $feedback->feedback_by_user;
            $feedbackFor = $feedback->feedback_for_user;

            // Send notification to the person who gave feedback
            if ($feedbackBy) {
                Mail::to($feedbackBy->email)->send(new \App\Mail\FeedbackApprovedNotification($feedback, 'giver'));
            }

            // Send notification to the person who received feedback
            if ($feedbackFor) {
                Mail::to($feedbackFor->email)->send(new \App\Mail\FeedbackApprovedNotification($feedback, 'receiver'));
            }

        } catch (\Exception $e) {
            Log::channel('queue-worker')->error("Failed to send feedback approval notification: " . $e->getMessage());
        }
    }
}
