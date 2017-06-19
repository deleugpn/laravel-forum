<?php

namespace Bitporch\Forum;

use Bitporch\Forum\Console\InstallCommand;
use Bitporch\Forum\Models\Group;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/forum.php' => config_path('forum.php'),
        ], 'config');

        $this->registerPackageNamespaces();

        View::composer('*', 'Bitporch\Forum\ViewComposers\GroupComposer');

        Route::bind('group', function ($slug) {
            return Group::where('slug', $slug)->firstOrFail();
        });
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
     * Define the application migrations, routes, views and translations.
     *
     * @return void
     */
    public function registerPackageNamespaces()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'forum');
        $this->loadTranslationsFrom(__DIR__.'/../resources/translations', 'forum');
    }
}
