<?php

namespace App\Services\Comment;

use App\Models\Entities\Event;
use App\Models\Entities\Comment;
use App\Repositories\Comment\CommentRepository;
use Cassandra\Collection;
use \Illuminate\Support\Facades\Facade;

class CommentFacade extends Facade {

    /**
     * Get the registered name of the component. This tells $this->app what record to return
     * (e.g. $this->app[‘commentService’])
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'commentService'; }

    /**
     * @param array $data
     * @param array $eventIds
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function createComment(array $data, array $eventIds)
    {
        /**
         * @var $repository CommentRepository
         */
        $repository = app()->get(self::getFacadeAccessor());

        $comment = $repository->saveItem($data);

        $repository->attacheToEvents($eventIds);

        return $comment;
    }

    /**
     * @param Comment $comment
     * @return bool|null
     * @throws \Exception
     */
    public static function deleteComment(Comment $comment)
    {
        /**
         * @var $repository CommentRepository
         */
        $repository = app()->get(self::getFacadeAccessor());

        return $repository->deleteItem($comment);
    }

    /**
     * @param Comment $comment
     * @return bool
     */
    public static function updateComment(Comment $comment)
    {
        /**
         * @var $repository CommentRepository
         */
        $repository = app()->get(self::getFacadeAccessor());

        return $repository->updateActiveStatus($comment);
    }

    /**
     * Get latest comments
     *
     * @return mixed
     */
    public static function getActiveItemsByEventId(Event $event)
    {
        /**
         * @var $repository CommentRepository
         */
        $repository = app()->get(self::getFacadeAccessor());

        return $repository->getActiveItemsByEventId($event);
    }

    /**
     * Get latest comments
     *
     * @return mixed
     */
    public static function getActiveItemsLatestFirst()
    {
        /**
         * @var $repository CommentRepository
         */
        $repository = app()->get(self::getFacadeAccessor());

        return $repository->getActiveItemsLatestFirst();
    }
}
