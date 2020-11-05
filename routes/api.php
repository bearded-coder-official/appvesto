<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => ['api']], function () {

    // Events
    Route::group(['prefix' => 'events'], function () {
        Route::get('', 'EventsController@getAll');
        Route::get('{event}', 'EventsController@getEvent');

        Route::get('{event}/comments', 'CommentsController@getByEventId');
    });

    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::post('', 'CommentsController@create');
        Route::delete('{comment}', 'CommentsController@delete');
        Route::patch('{comment}', 'CommentsController@update');
        Route::get('', 'CommentsController@getAll');
    });
});
