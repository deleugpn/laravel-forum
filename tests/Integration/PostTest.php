<?php

namespace Bitporch\Tests\Integration;

use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Models\Post;
use Bitporch\Tests\Stubs\Models\User;
use Bitporch\Tests\TestCase;

class PostTest extends TestCase
{
    public function testCreatePost()
    {
        $discussion = factory(Discussion::class)->create();
        $user = factory(User::class)->create();
        $content = $this->faker()->sentence;

        $this->actingAs($user)
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

    /**
     * @group f
     */
    public function testUpdatePost()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $content = $this->faker()->sentence;

        $this->actingAs($user)
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
        $post = factory(Post::class)->create();

        $this->delete(route('forum.posts.destroy', $post->id))
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $post->discussion->id)
            ->assertSessionHas('success', 'Post deleted successfully.');

        $this->dontSeeInDatabase('posts', ['id' => $post]);
    }
}
