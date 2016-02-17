<?php

namespace PublicFunction\YouTube;

use Illuminate\Support\ServiceProvider;

class YouTubeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/database/migrations') => $this->app->databasePath().'/migrations',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';

        $userConfigFile    = app()->configPath().'/publicfunction/youtube/config.php';
        $packageConfigFile = __DIR__.'/config/config.php';
        $config            = $this->app['files']->getRequire($packageConfigFile);

        if (file_exists($userConfigFile)) {
            $userConfig = $this->app['files']->getRequire($userConfigFile);
            $config     = array_replace_recursive($config, $userConfig);
        }

        $this->app['config']->set('youtube', $config);
        $this->app->make('PublicFunction\YouTube\YouTubeController');
    }
}
