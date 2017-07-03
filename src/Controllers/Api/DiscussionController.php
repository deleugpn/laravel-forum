<?php

namespace Bitporch\Forum\Controllers\Api;

use Bitporch\Forum\Controllers\Controller;
use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Requests\Discussions\CreateDiscussionRequest;
use Bitporch\Forum\Requests\Discussions\UpdateDiscussionRequest;
use Bitporch\Forum\Services\DiscussionService;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Discussion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDiscussionRequest $request
     * @param DiscussionService $discussionService
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request, DiscussionService $discussionService)
    {
        $discussion = $discussionService->store(
            $request->user(), ['title' => $request->get('title')], ['content' => $request->get('content')], $request->get('group_id')
        );

        return response($discussion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Discussion $discussion
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        $discussion->posts = $discussion->posts()
            ->paginate(config('forum.pagination.posts'));

        return response($discussion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDiscussionRequest $request
     * @param Discussion              $discussion
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionRequest $request, Discussion $discussion)
    {
        $discussion->update($request->all());

        return response($discussion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discussion $discussion
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return response($discussion, 204);
    }
}
