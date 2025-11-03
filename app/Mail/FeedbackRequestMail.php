<?php

namespace App\Mail;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $otherParty;
    public $recipientType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobPost $job, User $otherParty, string $recipientType)
    {
        $this->job = $job;
        $this->otherParty = $otherParty;
        $this->recipientType = $recipientType; // 'employer' or 'freelancer'
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Feedback Request - Job Completed';
        
        // Generate encrypted feedback URL parameters
        // user_id is the person GIVING feedback (the email recipient)
        // user_type is their role type
        $encrypted_job_id = encrypt($this->job->id);
        
        if ($this->recipientType == 'employer') {
            // Email going to employer
            $encrypted_user_id = encrypt($this->job->employer_id);
        } else {
            // Email going to freelancer - need to find freelancer_id from job actions
            $freelancerAction = \App\Models\JobAction::where('job_post_id', $this->job->id)
                ->where('action', \App\Models\JobAction::ACTION_ACCEPT)
                ->first();
            $encrypted_user_id = $freelancerAction ? encrypt($freelancerAction->freelancer_id) : encrypt($this->otherParty->id);
        }
        
        $encrypted_user_type = encrypt($this->recipientType);
        
        $feedbackUrl = url('/feedback') . 
                      "?job_id={$encrypted_job_id}" .
                      "&user_id={$encrypted_user_id}" .
                      "&user_type={$encrypted_user_type}";
        
        return $this->subject($subject)
                    ->view('mail.feedback-request')
                    ->with([
                        'job' => $this->job,
                        'otherParty' => $this->otherParty,
                        'recipientType' => $this->recipientType,
                        'feedbackUrl' => $feedbackUrl,
                    ]);
    }
}
