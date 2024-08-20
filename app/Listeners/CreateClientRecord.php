<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\user_client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateClientRecord
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
    public function handle(UserRegistered $event)
    {
        if ($event->user->user_type == 2) {
            User_client::create([
                'id_user' => $event->user->id,
                'phone' => $event->user->phone,
                'username' => $event->aditionalData['username'] ?? '',
                'gender' => $event->aditionalData['gender'] ?? 2,
                'birthday' => $event->aditionalData['birthday'] ?? null,
            ]);
        }
    }
}
