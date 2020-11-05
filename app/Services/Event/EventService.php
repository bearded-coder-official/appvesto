<?php

namespace App\Services\Event;

use App\Models\Entities\Event;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Event\EventInterface;

class EventService
{
    protected $eventRepo;

    public function __construct(EventInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    /**
     * retrieves the item by id
     *
     * @param  int $itemId
     * @return Event
     */
    public function get($itemId)
    {
        return $this->eventRepo->getById($itemId);
    }

    /**
     * creates a item with the given data
     *
     * @param array $data
     * @return Model
     */
    public function save(array $data)
    {
        return $this->eventRepo->saveItem($data);
    }

    /**
     * Update item
     *
     * @param Event $item
     * @param array $data
     * @return Model
     */
    public function edit(Event $item, array $data)
    {
        return $this->eventRepo->editItem($item, $data);
    }

    /**
     * Remove the event
     *
     * @param Event $item
     * @return mixed
     */
    public function delete(Event $item)
    {
        return $this->eventRepo->deleteItem($item);
    }

    /**
     * Get all active items
     *
     * @return mixed
     */
    public function getActiveItemsLatestFirst() {
        return $this->eventRepo->getActiveItemsLatestFirst();
    }

    /**
     * Change the active status
     *
     * @param Event $item
     * @return bool
     */
    public function updateActiveStatus(Event $item)
    {
        return $this->eventRepo->updateActiveStatus($item);
    }
}
