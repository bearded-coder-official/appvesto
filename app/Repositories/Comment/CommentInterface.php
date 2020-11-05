<?php

namespace App\Repositories\Comment;

use App\Models\Entities\Comment;

interface CommentInterface
{
    public function getById(int $itemId);

    public function saveItem(array $itemData);

    public function editItem(Comment $item, array $itemData);

    public function deleteItem(Comment $item);

    public function getActiveItemsLatestFirst();

    public function updateActiveStatus(Comment $comment);
}
