<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HighFieldCertificate extends Notification
{
    use Queueable;

    protected $message;
    protected $task_url;

    public function __construct($message,$task_url)
    {
        $this->message = $message;
        $this->task_url = $task_url;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Send both email and dashboard notification
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Highfield Certificate Uploaded')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->message)
            ->action('View Your Certificate', $this->task_url)
            ->line('Thank you for being a valued learner.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'task_url' => $this->task_url
        ];
    }
}
