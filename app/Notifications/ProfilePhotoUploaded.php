<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfilePhotoUploaded extends Notification
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
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'task_url' => $this->task_url
        ];
    }
}
