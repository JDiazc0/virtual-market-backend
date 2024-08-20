<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\store;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStoreRecord
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
        if ($event->user->user_type == 1) {
            Store::create([
                'id_user' => $event->user->id,
                'store_name' => $event->aditionalData['store_name'] ?? '',
                'description' => $event->aditionalData['description'] ?? '',
                'phone' => $event->aditionalData['phone_store'] ?? '',
                'address' => $event->aditionalData['address'] ?? '',
                'neighborhood' => $event->aditionalData['neighborhood'] ?? '',
                'rating' => $event->aditionalData['rating'] ?? 0,
            ]);
        }
    }
}
