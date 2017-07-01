<?php

namespace Bitporch\Tests\Integration;

use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Models\Post;
use Bitporch\Tests\Stubs\Models\User;
use Bitporch\Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * @test
     */
    public function a_user_can_create_a_post()
    {

        $this->signIn();

        $discussion = create(Discussion::class);
        $content = $this->faker()->sentence;

        $this->post(route('forum.posts.store'), [
                'discussion_id' => $discussion->id,
                'content'       => $content,
            ])
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $discussion->id);

    //     $this->seeInDatabase('posts', ['content' => $content, 'discussion_id' => $discussion->id]);
    }

    /**
     * @test
     */
    public function a_guest_cannot_create_a_post()
    {
        $discussion = create(Discussion::class);
        $content = $this->faker()->sentence;

        $this->withExceptionHandler()
            ->post(route('forum.posts.store'), [
            'discussion_id' => $discussion->id,
            'content'       => $content,
        ])
            ->assertRedirectedToRoute('forum.login');
    }

    /**
     * @test
     */
    public function a_user_cannot_create_an_invalid_post()
    {
        $this->withExceptionHandler()
            ->signIn()
            ->post(route('forum.posts.store'))
            ->assertResponseStatus(302)
            ->assertSessionHasErrors([
                'content'       => 'The content field is required.',
                'discussion_id' => 'The discussion id field is required.',
            ]);
    }

    /**
     * @test
     */
    public function a_user_can_update_his_own_post()
    {

        $post = $this->signInAndSeedPost();
        $content = $this->faker()->sentence;

        $this->put(route('forum.posts.update', $post->id), [
                'content'       => $content,
            ])
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $post->discussion->id);

    }

    /**
     * @test
     */
    public function a_user_cannot_update_someone_elses_post()
    {
        $this->signIn();
        $post = create(Post::class);
        $content = $this->faker()->sentence;

        $this->put(route('forum.posts.update', $post->id), [
            'content'       => $content,
        ])
            ->assertResponseStatus(401);

        $this->seeInDatabase('posts', ['id' => $post->id, 'content' => $post->content, 'discussion_id' => $post->discussion->id]);
        $this->dontSeeInDatabase('posts', ['id' => $post->id, 'content' => $content]);
    }

    /**
     * @test
     */
    public function a_user_can_erase_his_post()
    {
        $post = $this->signInAndSeedPost();
        $this->delete(route('forum.posts.destroy', $post->id))
            ->assertResponseStatus(302)
            ->assertRedirectedToRoute('forum.discussions.show', $post->discussion->id)
            ->assertSessionHas('success', 'Post deleted successfully.');
        $this->dontSeeInDatabase('posts', ['id' => $post]);
    }

    /**
     * @test
     */
    public function a_user_cannot_erase_someone_elses_post()
    {
        $this->signIn();
        $post = create(Post::class);

        $this->delete(route('forum.posts.destroy', $post->id))
            ->assertResponseStatus(401);

        $this->seeInDatabase('posts', ['id' => $post]);
    }

    /**
     * Helper method that signs in and creates a post under the signed in user.
     *
     * @return Post
     */
    private function signInAndSeedPost()
    {
        $this->signIn($user = create(User::class));

        return create(Post::class, ['user_id' => $user->id]);
    }
}
