<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->text('content');
            $table->boolean('is_active')->default(1);

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('comment_event', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('event_id');

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('comment_id')
                ->references('id')->on('comments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('event_id')->references('id')->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_event');
        Schema::dropIfExists('comments');
    }
}
