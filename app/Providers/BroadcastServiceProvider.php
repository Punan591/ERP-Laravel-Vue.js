<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

    /*
     * Authenticate the user's personal channel...
     */
    Broadcast::channel('private-user.{userId}', function ($user, $userId) {
        return (int) $user->id === (int) $userId;
    });
    }
}
