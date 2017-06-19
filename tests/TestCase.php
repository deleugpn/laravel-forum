<?php

namespace Bitporch\Tests;

use Bitporch\Forum\ForumServiceProvider;
use Bitporch\Tests\Stubs\Models\User;
use Exception;
use Faker\Factory as Faker;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler;
use Mockery;
use Orchestra\Database\ConsoleServiceProvider;
use Orchestra\Testbench\BrowserKit\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ForumServiceProvider::class, ConsoleServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('forum.user', User::class);
        $app['config']->set('forum.prefix', 'forum');
        $app['config']->set('forum.namespace', '\Bitporch\Forum\Controllers');
    }

    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/Stubs/migrations/');
        $this->withFactories(__DIR__.'/../database/factories/');

        $this->artisan('migrate', ['--database' => 'testbench']);
    }

    protected function faker()
    {
        return Faker::create();
    }

    public function tearDown()
    {
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        Mockery::close();
    }

    protected function resolveApplicationExceptionHandler($app)
    {
        $app->singleton(ExceptionHandler::class, PassThroughHandler::class);
    }

    protected function withExceptionHandler()
    {
        $this->app->singleton('Illuminate\Contracts\Debug\ExceptionHandler', 'Orchestra\Testbench\Exceptions\Handler');

        return $this;
    }
}

class PassThroughHandler extends Handler
{
    public function __construct()
    {
    }

    public function report(Exception $e)
    {
        // no-op
    }

    public function render($request, Exception $e)
    {
        throw $e;
    }
}
