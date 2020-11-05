<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="comments",
 *     description="Comment model",
 *     type="object",
 *     title="Comment model",
 *
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string", description="event title", example="אירוע חנוכה"),
 *     @OA\Property(property="content", type="string", description="event description", example="חג החנוכה הוא..."),
 *     @OA\Property(property="is_active", type="boolean", description="is the event displayed in the app"),
 * )
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'content',
        'is_active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
