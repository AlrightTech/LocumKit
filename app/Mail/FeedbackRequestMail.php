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
        
        return $this->subject($subject)
                    ->view('mail.feedback-request')
                    ->with([
                        'job' => $this->job,
                        'otherParty' => $this->otherParty,
                        'recipientType' => $this->recipientType,
                    ]);
    }
}
