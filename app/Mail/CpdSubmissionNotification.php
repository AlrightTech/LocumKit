<?php

namespace App\Mail;

use App\Models\CpdSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CpdSubmissionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CpdSubmission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New CPD Submission Received - LocumKit')
                    ->view('mail.cpd-submission-notification')
                    ->with([
                        'submission' => $this->submission,
                    ]);
    }
}
