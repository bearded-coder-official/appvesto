<?php

namespace App\Services\Comment;

use App\Models\Entities\Comment;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Comment\CommentInterface;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Retrieves the item by id
     *
     * @param  int $itemId
     * @return Comment
     */
    public function get($itemId)
    {
        return $this->commentRepository->getById($itemId);
    }

    /**
     * Creates a item with the given data
     *
     * @param array $data
     * @return Model
     */
    public function save(array $data)
    {
        return $this->commentRepository->saveItem($data);
    }

    /**
     * Update item
     *
     * @param Comment $item
     * @param array $data
     * @return Model
     */
    public function edit(Comment $item, array $data)
    {
        return $this->commentRepository->editItem($item, $data);
    }

    /**
     * Remove the comment
     *
     * @param Comment $item
     * @return mixed
     */
    public function delete(Comment $item)
    {
        return $this->commentRepository->deleteItem($item);
    }

    /**
     * Get all active items
     *
     * @return mixed
     */
    public function getActiveItemsLatestFirst() {
        return $this->commentRepository->getActiveItemsLatestFirst();
    }

    /**
     * Change the active status
     *
     * @param Comment $item
     * @return bool
     */
    public function updateActiveStatus(Comment $item)
    {
        return $this->commentRepository->updateActiveStatus($item);
    }
}
