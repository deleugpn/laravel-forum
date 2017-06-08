<?php

Route::prefix(config('forum.prefix'))->namespace(config('forum.namespace'))->group(function () {
    Route::resource('groups', 'GroupController', ['store', 'update', 'destroy']);
    Route::resource('discussions', 'DiscussionController', ['store', 'update', 'destroy']);
    Route::resource('posts', 'PostController', ['store', 'update', 'destroy']);
});
