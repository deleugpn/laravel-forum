<?php

namespace Bitporch\Tests;

use Bitporch\Forum\ForumServiceProvider;
use Bitporch\Tests\Stubs\Models\User;
use Exception;
use Faker\Factory as Faker;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Foundation\Application;
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
            'driver'    => 'sqlite',
            'database'  => ':memory:',
            'prefix'    => '',
        ]);

        $settings = require __DIR__.'/../config/forum.php';

        $this->applySettings($app, $settings);

        $app['config']->set('forum.user', User::class);
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

    /**
     * Automatically disables exception handling for tests.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function resolveApplicationExceptionHandler($app)
    {
        $app->singleton(ExceptionHandler::class, PassThroughHandler::class);
    }

    /**
     * Enables exception handling for tests.
     *
     * @return $this
     */
    protected function withExceptionHandler()
    {
        $this->app->singleton('Illuminate\Contracts\Debug\ExceptionHandler', 'Orchestra\Testbench\Exceptions\Handler');

        return $this;
    }

    protected function signIn(User $user = null)
    {
        $user = $user ?: create(User::class);

        return $this->actingAs($user);
    }

    /**
     * Apply recursively all the array settings into the application.
     *
     * @param Application $app
     * @param array       $settings
     * @param string      $prefix
     */
    private function applySettings(Application &$app, array $settings, $prefix = 'forum.')
    {
        foreach ($settings as $config => $value) {
            if (is_array($value)) {
                $this->applySettings($app, $value, $prefix.$config.'.');
            } else {
                $app['config']->set($prefix.$config, $value);
            }
        }
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
