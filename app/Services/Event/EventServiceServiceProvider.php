<?php

namespace App\Services\Event;

use Illuminate\Support\ServiceProvider;

class EventServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('eventService', function($app) {
            return new EventService(
                $app->make('App\Repositories\Event\EventInterface')
            );
        });
    }
}
