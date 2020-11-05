<?php

namespace App\Repositories\Event;

use App\Models\Entities\Event;
use Illuminate\Support\ServiceProvider;

class EventRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Event\EventInterface', function($app) {
            return new EventRepository(new Event());
        });
    }
}
