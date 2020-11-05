<?php

namespace App\Repositories\Event;

use App\Models\Entities\Event;
use Illuminate\Database\Eloquent\Model;

class EventRepository implements EventInterface
{
    protected $model;

    public function __construct(Event $item)
    {
        $this->model = $item;
    }

    /**
     * retrieves the Event by id
     *
     * @param  int $itemId
     * @return int
     */
    public function getById(int $itemId)
    {
        return $this->model->find($itemId);
    }

    /**
     * creates a new item with the given data
     *
     * @param array $itemData
     * @return Model
     */
    public function saveItem(array $itemData)
    {
        return $this->model->create($itemData);
    }

    /**
     * Edit item
     *
     * @param Event $item
     * @param array $itemData
     * @return bool
     */
    public function editItem(Event $item, array $itemData)
    {
        return $item->update($itemData);
    }

    /**
     * @param Event $item
     * @return bool|null
     * @throws \Exception
     */
    public function deleteItem(Event $item)
    {
        return $item->delete();
    }

    /**
     * Get all active items
     *
     * @return mixed
     */
    public function getActiveItemsLatestFirst() {
        return $this->model
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->get()
        ;
    }

    /**
     * Change the active status
     *
     * @param Event $item
     * @return bool
     */
    public function updateActiveStatus(Event $item)
    {
        return $item->update(['is_active' => !$item->is_active]);
    }

}
