<?php

namespace App\Notifications;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobCompletedNotification extends Notification
{
    use Queueable;

    public $job;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(JobPost $job, User $user)
    {
        $this->job = $job;
        $this->user = $user;
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
        return (new MailMessage)
                    ->subject('Job Marked as Completed')
                    ->line("A job has been marked as completed by {$this->user->firstname} {$this->user->lastname}")
                    ->line("Job Title: {$this->job->job_title}")
                    ->line("Job Date: {$this->job->job_date->format('d/m/Y')}")
                    ->line("Job Rate: £{$this->job->job_rate}")
                    ->action('View Job Details', url("/admin/job/{$this->job->id}"))
                    ->line('Please review the job completion and ensure all feedback has been collected.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'job_id' => $this->job->id,
            'job_title' => $this->job->job_title,
            'job_date' => $this->job->job_date->format('d/m/Y'),
            'job_rate' => $this->job->job_rate,
            'completed_by' => $this->user->firstname . ' ' . $this->user->lastname,
            'completed_by_id' => $this->user->id,
            'message' => "Job '{$this->job->job_title}' has been marked as completed by {$this->user->firstname} {$this->user->lastname}",
        ];
    }
}
