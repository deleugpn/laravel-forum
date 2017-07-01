<?php

namespace Bitporch\Tests\Unit\Eloquent;

use Bitporch\Tests\Stubs\Models\User;
use Bitporch\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function a_user_has_discussions()
    {
        $user = create(User::class);

        $this->assertInstanceOf(Collection::class, $user->discussions);
    }
}
