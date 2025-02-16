<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\InstructorUploadedAssignment;
use App\Notifications\AssignmentUploadedNotification;

class NotifyStudentsAboutAssignment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InstructorUploadedAssignment $event): void
    {
        $assignment = $event->assignment;
        // Send notification to all students enrolled in the course
        $assignment->course->user->each(function ($user) use ($assignment) {
            Log::info('Notification sent to student: ' . $user->username . ' for assignment: ' . $assignment->title);
            $user->notify(new AssignmentUploadedNotification($assignment));
        });

    }
}
