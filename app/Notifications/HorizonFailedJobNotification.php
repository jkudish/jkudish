<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Laravel\Horizon\Contracts\JobFailed;

class HorizonFailedJobNotification extends Notification
{
    use Queueable;

    /**
     * The failed job event.
     */
    public JobFailed $event;

    /**
     * Create a new notification instance.
     */
    public function __construct(JobFailed $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->error()
            ->subject('⚠️ Failed Job Alert - '.config('app.name'))
            ->greeting('Failed Job Alert')
            ->line('A job has failed on '.config('app.name').'.')
            ->line('**Job Class:** '.$this->event->job->displayName())
            ->line('**Queue:** '.$this->event->job->queue)
            ->line('**Failed At:** '.now()->format('Y-m-d H:i:s T'))
            ->line('**Exception:** '.$this->event->exception->getMessage())
            ->action('View Horizon Dashboard', url('/horizon'))
            ->line('Please investigate this issue as soon as possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job' => $this->event->job->displayName(),
            'queue' => $this->event->job->queue,
            'exception' => $this->event->exception->getMessage(),
            'failed_at' => now()->toDateTimeString(),
        ];
    }
}
