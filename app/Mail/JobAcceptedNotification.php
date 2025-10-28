<?php

namespace App\Mail;

use App\Models\JobPost;
use App\Models\PrivateUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobAcceptedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $freelancer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobPost $job, $freelancer)
    {
        $this->job = $job;
        $this->freelancer = $freelancer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Job Accepted - LocumKit')
                    ->view('mail.job-accepted-notification')
                    ->with([
                        'job' => $this->job,
                        'freelancer' => $this->freelancer,
                    ]);
    }
}
