<?php

namespace Anbu;

use Illuminate\Support\ServiceProvider;

class ProfilerServiceProvider extends ServiceProvider
{
    /**
     * Register Artisan commands.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands('Anbu\\Commands\\InstallCommand');
    }

    /**
     * Register the Anbu profiler.
     *
     * @return void
     */
    public function register()
    {
        // Instantiate the profiler.
        $anbu = $this->app->make('Anbu\\Profiler');

        // Fire module register events.
        $anbu->registerModules($this->app);

        // Register event listeners.
        $anbu->registerListeners();

        // Bind within container.
        $this->app->instance('anbu', $anbu);

        // Register routes.
        $this->registerRoutes();

        // Register Anbu view namespace.
        $this->registerViewNamespace();
    }

    /**
     * Register profiler routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        // Get the router.
        $route = $this->app->make('router');

        // Bind asset controller route.
        $route->get(
            'anbu/asset/{module}/{path}',
            'Anbu\\Controllers\\AssetController@index'
        );

        // Bind profiler display route.
        $route->get(
            'anbu/{storage?}/{module?}',
            'Anbu\\Controllers\\ProfilerController@index'
        );
    }

    /**
     * Register the namespace for Anbu's templates.
     *
     * @return void
     */
    protected function registerViewNamespace()
    {
        // Get view component.
        $view = $this->app->make('view');

        // Register anbu directory as view namespace.
        $view->addNamespace('anbu', __DIR__);
    }
}
