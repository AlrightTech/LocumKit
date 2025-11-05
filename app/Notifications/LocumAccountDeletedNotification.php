<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocumAccountDeletedNotification extends Notification
{
    use Queueable;

    protected $locumName;
    protected $jobTitle;
    protected $jobDate;
    protected $jobStatus;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($locumName, $jobTitle, $jobDate, $jobStatus)
    {
        $this->locumName = $locumName;
        $this->jobTitle = $jobTitle;
        $this->jobDate = $jobDate;
        $this->jobStatus = $jobStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $statusText = $this->jobStatus === 'ACCEPTED' ? 'accepted' : 'applied to';
        
        return (new MailMessage)
            ->subject('Locum No Longer Available - LocumKit')
            ->greeting('Dear ' . $notifiable->firstname . ' ' . $notifiable->lastname . ',')
            ->line("We regret to inform you that the locum {$this->locumName} who {$statusText} your job is no longer available on LocumKit.")
            ->line("Job Details:")
            ->line("• Job Title: {$this->jobTitle}")
            ->line("• Job Date: {$this->jobDate}")
            ->line("• Previous Status: {$this->jobStatus}")
            ->line('The locum has deleted their account, and the associated job posting has been automatically removed from your active listings.')
            ->line('You may need to repost this job to find another suitable locum.')
            ->action('View Job Management', url('/employer/managejob'))
            ->line('Thank you for using LocumKit!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $statusText = $this->jobStatus === 'ACCEPTED' ? 'accepted' : 'applied to';
        
        return [
            'title' => 'Locum No Longer Available',
            'message' => "The locum {$this->locumName} who {$statusText} your job '{$this->jobTitle}' (Date: {$this->jobDate}) has deleted their account and is no longer available. The job has been removed from your active listings.",
            'job_title' => $this->jobTitle,
            'job_date' => $this->jobDate,
            'locum_name' => $this->locumName,
            'job_status' => $this->jobStatus
        ];
    }
}

