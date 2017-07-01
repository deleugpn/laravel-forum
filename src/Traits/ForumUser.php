<?php

namespace Bitporch\Forum\Traits;

use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Models\Post;

trait ForumUser
{
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
