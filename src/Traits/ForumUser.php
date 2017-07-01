<?php

namespace Bitporch\Forum\Traits;

use Bitporch\Forum\Relationships\HasManyDiscussions;
use Bitporch\Forum\Relationships\HasManyPosts;

trait ForumUser
{
    use HasManyPosts, HasManyDiscussions;
}
