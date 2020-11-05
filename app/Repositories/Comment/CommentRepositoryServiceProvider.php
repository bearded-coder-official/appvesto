<?php

namespace App\Repositories\Comment;

use App\Models\Entities\Comment;
use Illuminate\Support\ServiceProvider;

class CommentRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Comment\CommentInterface', function($app) {
            return new CommentRepository(new Comment());
        });
    }
}
