<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal;
use App\Models\Entities\Comment;
use App\Exceptions\TransformerException;

class CommentsTransformer extends Fractal\TransformerAbstract
{
    public static function transformSingleEventFull(Comment $comment)
    {
        try {
            return [
                'id'                    => (int)    $comment->id,
                'title'                 => (string) $comment->title,
                'content'               => (string) $comment->content,
            ];
        }
        catch (\Exception $exception) {
            throw new TransformerException('SINGLE_COMMENT');
        }
    }
    public static function transformSingleEventShort(Comment $item)
    {
        try {
            return [
                'id'                    => (int)    $item->id,
                'title'                 => (string) $item->title,
                'created_at'            => (int)    $item->created_at->timestamp,
            ];
        }
        catch (\Exception $exception) {
            throw new TransformerException('SINGLE_COMMENT');
        }
    }

    public static function transform($items)
    {
        try {
            return $items->map(function($item) {
                return self::transformSingleEventShort($item);
            });
        }
        catch (\Exception $exception) {
            throw new TransformerException('COMMENTS');
        }
    }

    private static function getHebrewDateStr(Carbon $date) {
        $response = '';

        // Day
        $response .= $date->getTranslatedShortDayName('dd') . ', ';

        // Date
        $response .= $date->day . ' ';
        $response .= $date->getTranslatedShortMonthName('MMM') . ' ';
        $response .= $date->year . '  ';

        // Time
        $response .= $date->format('H:i');

        return $response;
    }

}
