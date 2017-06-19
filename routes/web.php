<?php

Route::prefix(config('forum.prefix'))->middleware(config('forum.middleware.web'))->namespace(config('forum.namespace'))->name('forum.')->group(function () {
    Route::get('/', 'ForumController@index')->name('home');
    Route::post('search', 'ForumController@search')->name('search');

    Route::resource('groups', 'GroupController');
    Route::resource('discussions', 'DiscussionController');
    Route::resource('posts', 'PostController');

    Route::resource('lock', 'Discussion\LockController', [
        'only' => ['store', 'destroy'],
    ]);

    Route::resource('sticky', 'Discussion\StickyController', [
        'only' => ['store', 'destroy'],
    ]);
});
