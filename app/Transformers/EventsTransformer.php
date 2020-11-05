<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal;
use App\Models\Entities\Event;
use App\Exceptions\TransformerException;

class EventsTransformer extends Fractal\TransformerAbstract
{
    public static function transformSingleEventFull(Event $event)
    {
        try {
            return [
                'id'                    => (int)    $event->id,
                'title'                 => (string) $event->title,
                'content'               => (string) $event->content,
                'start_date_str'        => (string) self::getHebrewDateStr($event->start_time),
                'end_date_str'          => (string) $event->end_time? self::getHebrewDateStr($event->end_time) : '',
                'start_date_iso_8601'   => (string) $event->start_time->toIso8601String(),
                'end_date_iso_8601'     => (string) $event->end_time? $event->end_time->toIso8601String() : '',
                'location'              => (string) $event->location,
                'image'                 => (string) $event->image ? url('uploads/original/' . $event->image) : '',
                'pdf'                   => (string) $event->pdf ? url('uploads/original/' . $event->pdf) : '',
            ];
        }
        catch (\Exception $exception) {
            throw new TransformerException('SINGLE_EVENT');
        }
    }
    public static function transformSingleEventShort(Event $item)
    {
        try {
            return [
                'id'                    => (int)    $item->id,
                'title'                 => (string) $item->title,
                'start_date_str'        => (string) self::getHebrewDateStr($item->start_time),
                'start_date_iso_8601'   => (string) $item->start_time->toIso8601String(),
                'location'              => (string) $item->location,
                'image'                 => (string) $item->image ? url('uploads/original/' . $item->image) : '',
                'created_at'            => (int)    $item->created_at->timestamp,
            ];
        }
        catch (\Exception $exception) {
            throw new TransformerException('SINGLE_EVENT');
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
            throw new TransformerException('EVENTS');
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
