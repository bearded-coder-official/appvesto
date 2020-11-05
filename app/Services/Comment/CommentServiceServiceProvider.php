<?php

namespace App\Services\Comment;

use Illuminate\Support\ServiceProvider;

class CommentServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('commentService', function($app) {
            return new CommentService(
                $app->make('App\Repositories\Comment\CommentInterface')
            );
        });
    }
}
