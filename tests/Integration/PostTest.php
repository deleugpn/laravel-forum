<?php

namespace Bitporch\Tests\Integration;

use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Models\Post;
use Bitporch\Tests\TestCase;

class PostTest extends TestCase
{
    public function testCreatePost()
    {

        $discussion = create(Discussion::class);
        $content = $this->faker()->sentence;

        $this->signIn()
            ->post(route('forum.posts.store'), [
                'discussion_id' => $discussion->id,
                'content'       => $content,
            ])
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $discussion->id);

        $this->seeInDatabase('posts', ['content' => $content, 'discussion_id' => $discussion->id]);
    }

    public function testCreatePostValidation()
    {
        $this->withExceptionHandler()
            ->post(route('forum.posts.store'))
            ->assertResponseStatus(302)
            ->assertSessionHasErrors([
                'content'       => 'The content field is required.',
                'discussion_id' => 'The discussion id field is required.',
            ]);
    }

    public function testUpdatePost()
    {
        $post = create(Post::class);
        $content = $this->faker()->sentence;

        $this->signIn()
            ->put(route('forum.posts.update', $post->id), [
                'content'       => $content,
            ])
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $post->discussion->id);

        $this->seeInDatabase('posts', ['id' => $post->id, 'content' => $content, 'discussion_id' => $post->discussion->id]);
        $this->dontSeeInDatabase('posts', ['id' => $post->id, 'content' => $post->content]);
    }

    public function testDestroyPost()
    {
        $post = create(Post::class);

        $this->delete(route('forum.posts.destroy', $post->id))
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $post->discussion->id)
            ->assertSessionHas('success', 'Post deleted successfully.');

        $this->dontSeeInDatabase('posts', ['id' => $post]);
    }
}
