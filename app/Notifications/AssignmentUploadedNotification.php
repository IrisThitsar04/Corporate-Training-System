<?php

namespace App\Notifications;

use App\Models\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AssignmentUploadedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $assignment;

    public function __construct(Assignment $assignment)
    {
       $this->assignment = $assignment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Assignment Uploaded')
            ->line('A new assignment has been uploaded for ' . $this->assignment->course->name)
            ->action('View Assignment', url('/assignments/' . $this->assignment->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Assignment for course ' . $this->assignment->course->name . ' has been uploaded',
        ];
    }
}
