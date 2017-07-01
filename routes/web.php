<?php

Route::prefix(config('forum.web.prefix'))->middleware(config('forum.web.middleware'))->namespace(config('forum.web.namespace'))->name('forum.')->group(function () {
    Route::get('/', 'ForumController@index')->name('home');
    Route::get('search', 'ForumController@search')->name('search');

    Route::resource('groups', 'GroupController');
    Route::resource('discussions', 'DiscussionController');
    Route::resource('posts', 'PostController');

    Route::patch('discussions/{discussion}/flags', 'Discussion\FlagController@update')->name('discussions.flag');
});
