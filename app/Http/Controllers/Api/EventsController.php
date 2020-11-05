<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\Event;
use App\Services\Event\EventFacade;
use App\Transformers\EventsTransformer;

class EventsController extends BaseController
{
    /**
     * Get all active events
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function getAll() {
        $items = EventFacade::getActiveItemsLatestFirst();
        if($items->count())
            return $this->success(EventsTransformer::transform($items));

        return $this->error('EVENT_ERRORS', 'NO_EVENTS');
    }
    /**
     * Get Single event
     *
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function getEvent(Event $event) {
        dd($event);
        dd(\App\Models\Entities\Event::all());
        if(!$event->is_active)
            return $this->error('EVENT_ERRORS', 'EVENT_NOT_FOUND');

        return $this->success(EventsTransformer::transformSingleEventFull($event));
    }
}
