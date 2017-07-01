<?php

namespace Bitporch\Forum\Traits;

use Bitporch\Forum\Models\Discussion;

trait ForumUser
{
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
