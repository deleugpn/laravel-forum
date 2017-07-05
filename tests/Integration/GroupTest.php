<?php

namespace Bitporch\Tests\Integration;

use Bitporch\Forum\Models\Group;
use Bitporch\Tests\TestCase;

class GroupTest extends TestCase
{
    /**
     * @test
     */
    public function a_guest_cannot_create_a_group()
    {
        $response = $this->withExceptionHandler()->post('/forum/groups', []);

        $response->assertResponseStatus(302)
            ->assertSessionHas('errors', 'You must be logged in to create a group.');
        // @TODO: Check redirecting to Login Route
    }

    /**
     * @test
     */
    public function a_user_can_see_the_group_form()
    {
        $this->signIn();

        $response = $this->get('/forum/groups/create');

        $response->assertResponseStatus(200)
            ->seeElement('[name="color"]')
            ->seeElement('[name="name"]');
    }

    /**
     * @test
     */
    public function a_user_can_create_a_group()
    {
        $this->signIn();

        $group = make(Group::class);

        $response = $this->post('/forum/groups', $group->toArray());

        $response->assertResponseStatus(302);
        $this->seeInDatabase('groups', ['name' => $group->name, 'color' => $group->color]);
    }
}
