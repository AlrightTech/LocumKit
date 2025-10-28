<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CpdReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $freelancer;
    public $currentCycle;
    public $daysUntilEnd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $freelancer, array $currentCycle, int $daysUntilEnd)
    {
        $this->freelancer = $freelancer;
        $this->currentCycle = $currentCycle;
        $this->daysUntilEnd = $daysUntilEnd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('CPD Submission Reminder - LocumKit')
                    ->view('mail.cpd-reminder')
                    ->with([
                        'freelancer' => $this->freelancer,
                        'currentCycle' => $this->currentCycle,
                        'daysUntilEnd' => $this->daysUntilEnd,
                    ]);
    }
}
