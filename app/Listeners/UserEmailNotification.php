<?php

namespace App\Listeners;

use App\Events\UserRegisteredNotification;
use App\Mail\User\UserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserEmailNotification
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
     * @param  \App\Events\UserRegisteredNotification  $event
     * @return void
     */
    public function handle(UserRegisteredNotification $event)
    {
        Mail::to($event->user['email'])->send(new UserNotification($event->user['name'], $event->user['password']));
    }
}
