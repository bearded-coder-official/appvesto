<?php

namespace App\Repositories\Event;

use App\Models\Entities\Event;

interface EventInterface
{
    public function getById(int $itemId);

    public function saveItem(array $itemData);

    public function editItem(Event $item, array $itemData);

    public function deleteItem(Event $item);

    public function getActiveItemsLatestFirst();

    public function updateActiveStatus(Event $event);
}
