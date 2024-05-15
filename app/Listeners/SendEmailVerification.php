<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\EmailVerification;
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

        Mail::to($event->user->email)->send(new EmailVerification($event->user));

    }
}
