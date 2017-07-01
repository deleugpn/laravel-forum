<?php

namespace Bitporch\Forum\Relationships;

use Bitporch\Forum\Models\Discussion;

trait HasManyDiscussions
{
    public function discussions() {
        return $this->hasMany(Discussion::class, 'user_id');
    }
}