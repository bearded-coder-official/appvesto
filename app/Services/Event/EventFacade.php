<?php

namespace App\Services\Event;

use \Illuminate\Support\Facades\Facade;

class EventFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘eventService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'eventService'; }

}
