<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
<<<<<<< HEAD
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\EmailVerification;
=======
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

>>>>>>> 2caf74e (task_3)
class SendEmailVerification
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
    public function handle(RegisteredUser $event): void
    {
<<<<<<< HEAD

        Mail::to($event->user->email)->send(new EmailVerification($event->user));

=======
        Mail::to($event->user->email)->send(new EmailVerification($event->user));
>>>>>>> 2caf74e (task_3)
    }
}
