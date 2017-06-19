<?php

namespace Bitporch\Forum\Controllers;

use Bitporch\Forum\Models\Post;
use Bitporch\Forum\Requests\Posts\CreatePostRequest;
use Bitporch\Forum\Requests\Posts\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Bitporch\Forum\Requests\Posts\CreatePostRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = Post::create($request->all());

        return redirect()->route('forum.discussions.show', $post->discussion_id);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Bitporch\Forum\Requests\Posts\UpdatePostRequest $request
     * @param Post                                             $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());

        return redirect()->route('forum.discussions.show', $post->discussion_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('forum.discussions.show', $post->discussion_id)->with('success', 'Post deleted successfully.');
    }
}
