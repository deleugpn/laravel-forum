<?php

namespace Bitporch\Forum\Relationships;

use Bitporch\Forum\Models\Post;

trait HasManyPosts
{
    public function posts() {
        return $this->hasMany(Post::class, 'user_id');
    }
}