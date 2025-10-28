<?php

namespace App\Mail;

use App\Models\JobFeedback;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;
    public $recipientType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobFeedback $feedback, string $recipientType)
    {
        $this->feedback = $feedback;
        $this->recipientType = $recipientType; // 'giver' or 'receiver'
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Feedback Approved - LocumKit')
                    ->view('mail.feedback-approved-notification')
                    ->with([
                        'feedback' => $this->feedback,
                        'recipientType' => $this->recipientType,
                    ]);
    }
}
