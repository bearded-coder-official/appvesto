<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="events",
 *     description="Event model",
 *     type="object",
 *     title="Event model",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string", description="event title", example="אירוע חנוכה"),
 *     @OA\Property(property="content", type="string", description="event description", example="חג החנוכה הוא..."),
 *     @OA\Property(property="start_time", type="timestamp", description="start date + time of the event"),
 *     @OA\Property(property="end_time", type="timestamp", description="start date + time of the event"),
 *     @OA\Property(property="location", type="string", description="event location in text", example="גני התערוכה, תל אביב"),
 *     @OA\Property(property="image", type="string", description="image to display. selected from file-manager.", example="uploads/original/YoKawOBIzIoGe3jeUJ0YrzPCFPJzSwDAIRcvVVu5.jpeg"),
 *     @OA\Property(property="pdf", type="string", description="pdf attachment. selected from file-manager.", example="uploads/original/YoKawOBIzIoGe3jeUJ0YrzPCFPJzSwDAIRcvVVu5.pdf"),
 *     @OA\Property(property="is_active", type="boolean", description="is the event displayed in the app"),
 * )
 */
class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'content',
        'start_time',
        'end_time',
        'location',
        'image',
        'pdf',
        'is_active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_time',
        'end_time',
    ];

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }
}
