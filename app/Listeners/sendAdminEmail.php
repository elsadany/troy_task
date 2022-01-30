<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\StudentAdded;
use App\Mail\adminNotificationMail;
class sendAdminEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(StudentAdded $student)
    {
          \Mail::to(config('admins.admin'))->send(
            new adminNotificationMail($student->student)
        );
    }
}
