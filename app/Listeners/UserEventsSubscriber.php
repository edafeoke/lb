<?php

namespace App\Listeners;

use Auth;

class UserEventsSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
	{

        if ($event->user) {
            $event->user->update([
                'last_login_at' => now()->toDateTimeString(),
                'last_login_ip' => request()->getClientIp(),
                'pin_verified_at' => null,
            ]);
            // Logging activity for user login
            activity()->performedOn($event->user)->withProperties([
                'name' => $event->user->username ? $event->user->username : $event->user->email,
                'by' => $event->user->username ? $event->user->username : $event->user->email
            ])->causedBy($event->user)->log('Account signed-in');
        }
	}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
	{
        // Logging activity for user login
        if ($event->user) {
            activity()->performedOn($event->user)->withProperties([
                'name' => $event->user->username ? $event->user->username : $event->user->email,
                'by' => $event->user->username ? $event->user->username : $event->user->email
            ])->causedBy($event->user)->log('Account signed-out');
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventsSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventsSubscriber@onUserLogout'
        );
    }

}
