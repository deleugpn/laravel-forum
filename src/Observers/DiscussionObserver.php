<?php

namespace Bitporch\Forum\Observers;

use Bitporch\Forum\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionObserver
{
    /**
     * Instantiate the observer.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Listen to the Discussion created event.
     *
     * @param Discussion $discussion
     *
     * @return void
     */
    public function created(Discussion $discussion)
    {
        $discussion->posts()->create([
            'discussion_id' => $discussion->id,
            'user_id'       => $this->request->user()->id,
            'content'       => $this->request->content,
        ]);

        $discussion->groups()->attach($this->request->group_id);
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
