<?php

namespace Bitporch\Forum\Services;

use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Traits\ForumUser;
use Illuminate\Support\Facades\Auth;

class DiscussionService
{

    /**
     * @param $user If PR-157 had been merged, we could type-hin the interface here
     * @param array $discussionData
     * @param array $postData
     * @param $groupId
     *
     * @return Discussion
     */
    public function store($user, array $discussionData, array $postData, $groupId)
    {
        $discussion = $user
            ->discussions()
            ->create($discussionData);

        $discussion->posts()->create(
            array_merge([
                'user_id' => $user->id,
            ], $postData)
        );

        $discussion->groups()->attach($groupId);

        return $discussion;
    }

    public function anotherStore(array $data, $groupId)
    {
        $discussion = $this->user()->discussions()->create($data);
        $discussion->groups()->attach($groupId);

        return $discussion;
    }

    /**
     * This would be a method in a super-class that all services would extend
     *
     * @return ForumUser
     */
    protected function user()
    {
        // Make sure to resolve web and token authentication
        return Auth::user();
    }
}