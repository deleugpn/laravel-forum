<?php

namespace Bitporch\Forum\Observers;

use Bitporch\Forum\Models\Discussion;

class DiscussionObserver
{
    /**
     * Listen to the Discussion created event.
     *
     * @param Discussion $discussion
     *
     * @return void
     */
    public function created(Discussion $discussion)
    {
        //
    }

    /**
     * Listen to the Discussion deleting event.
     *
     * @param Discussion $discussion
     *
     * @return void
     */
    public function deleting(Discussion $discussion)
    {
        //
    }
}
