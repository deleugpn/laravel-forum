<?php

namespace Bitporch\Tests\Unit;

use Bitporch\Forum\ForumServiceProvider;
use Bitporch\Tests\TestCase;
use RuntimeException;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     * @expectedException RuntimeException
     */
    public function the_user_settings_must_implement_the_user_contract()
    {
        $this->app['config']->set('forum.user', UserStub::class);

        $provider = new ForumServiceProvider($this->app);
        $provider->boot();
    }
}

class UserStub
{

}
