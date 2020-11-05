<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\Event;
use App\Models\Entities\Comment;
use App\Services\Comment\CommentFacade;
use App\Transformers\CommentsTransformer;

class CommentsController extends BaseController
{
    /**
     * Create comment
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function create() {
        try {
            $comment = CommentFacade::createComment(
                request()->only('title', 'content', 'is_active'),
                request()->only('event_ids') // array
            );
        } catch (\Exception $e) {
            return $this->error('COMMENT_ERRORS', 'CREATE_ERROR');
        }

        return $this->success(CommentsTransformer::transform($comment));
    }

    /**
     * Delete comment
     *
     * @param Comment $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function delete(Comment $comment) {
        try {
            CommentFacade::deleteComment($comment);
        } catch (\Exception $e) {
            return $this->error('COMMENT_ERRORS', 'DELETE_ERROR');
        }

        return response(null, 200);
    }

    /**
     * Update comment
     *
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function update(Comment $comment) {
        try {
            $comment = CommentFacade::updateComment($comment);
        } catch (\Exception $e) {
            return $this->error('COMMENT_ERRORS', 'UPDATE_STATUS_ERROR');
        }

        return $this->success(CommentsTransformer::transform($comment));
    }

    /**
     * Get comments by event id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function getByEventId(Event $event) {
        $items = CommentFacade::getActiveItemsByEventId($event->id);
        if($items->count())
            return $this->success(CommentsTransformer::transform($items));

        return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');
    }

    /**
     * Get all active comments
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function getAll() {
        $items = CommentFacade::getActiveItemsLatestFirst();
        if($items->count())
            return $this->success(CommentsTransformer::transform($items));

        return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');
    }
}
