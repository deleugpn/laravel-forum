<?php

namespace Bitporch\Forum;

use Bitporch\Forum\Console\InstallCommand;
use Bitporch\Forum\Contracts\User;
use Bitporch\Forum\Models\Discussion;
use Bitporch\Forum\Models\Group;
use Bitporch\Forum\Models\Post;
use Bitporch\Forum\Observers\DiscussionObserver;
use Bitporch\Forum\Observers\PostObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->performChecks();

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->loadTranslationsFrom(__DIR__.'/../resources/translations', 'forum');

        $this->publishes([
            __DIR__.'/../config/forum.php' => config_path('forum.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/forum'),
        ], 'forum');

        $this->registerRouteBindings();
        $this->registerPackageNamespaces();
        $this->registerModelObservers();
        $this->registerBladeDirectives();

        View::composer('*', 'Bitporch\Forum\ViewComposers\GroupComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register route bindings for models. We don't need to do this since we're following
     * the conventions by which route model bindings will happen automatically,
     * but this makes it obvious that the package relies on it.
     *
     * @return void
     */
    public function registerRouteBindings()
    {
        Route::model('discussion', Discussion::class);
        Route::model('group', Group::class);
        Route::model('post', Post::class);
    }

    /**
     * Define the application migrations, routes and views.
     *
     * @return void
     */
    public function registerPackageNamespaces()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if (config('forum.api.enabled')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        }

        if (config('forum.web.enabled')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'forum');
    }

    /**
     * Register the model observers.
     *
     * @return void
     */
    public function registerModelObservers()
    {
        Discussion::observe(DiscussionObserver::class);
        Post::observe(PostObserver::class);
    }

    /**
     * @return void
     */
    public function registerBladeDirectives()
    {
        Blade::directive('error', function ($type) {
            return '<?php
                if($errors->has('.$type.')) {
                    echo "<span class=\"help-block\">
                        <strong>{$errors->first('.$type.')}</strong>
                    </span>";
                }
                ?>
            ';
        });
    }

    private function performChecks()
    {
        $class = $this->app['config']->get('forum.user');
        $instance = $this->app->make($class);
        if (!$instance instanceof User)
            throw new RuntimeException("{$class} must implement ".User::class);
    }
}
