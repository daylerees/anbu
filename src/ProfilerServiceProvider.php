<?php

namespace Anbu;

use Illuminate\Support\ServiceProvider;

class ProfilerServiceProvider extends ServiceProvider
{
    /**
     * Default storage repository.
     */
    const DEFAULT_REPO = 'Anbu\\Repositories\\DatabaseRepository';

    /**
     * Register the Anbu profiler.
     *
     * @return void
     */
    public function boot()
    {
        // Get the configuration component.
        $config = $this->app->make('config');

        // Get debug setting as default enabled option.
        $default = $config->get('app.debug', false);

        // Get anbu enabled setting but provide default.
        $enabled = $config->get('anbu.enabled', $default);

        // If the profiler is disabled.
        if (!$enabled) {

            // Nothing to do here!
            return;
        }

        // Register clear command.
        $this->commands('Anbu\\Commands\\ClearCommand');

        // Ensure that required database table exists.
        $this->installTable();

        // Get the repository class.
        $repo = $config->get('anbu.repository', self::DEFAULT_REPO);

        // Bind the storage repository.
        $this->app->bind('Anbu\\Repositories\\Repository', $repo);

        // Instantiate the profiler.
        $anbu = $this->app->make('Anbu\\Profiler');

        // Fire module register events.
        $anbu->registerModules($this->app);

        // Register event listeners.
        $anbu->registerListeners();

        // Bind within container.
        $this->app->instance('Anbu\\Profiler', $anbu);

        // Register routes.
        $this->registerRoutes();

        // Register Anbu view namespace.
        $this->registerViewNamespace();
    }

    /**
     * Register the Anbu profiler.
     *
     * @return void
     */
    public function register()
    {
        //
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

        // Register filters.
        $route->filter('anbu.hide', 'Anbu\\Filters\\ProfilerFilter@hide');
        $route->filter('anbu.disable', 'Anbu\\Filters\\ProfilerFilter@disable');

        // Bind profiler display route.
        $route->get(
            'anbu/{storage?}/{module?}',
            [
                'before'    => 'anbu.disable',
                'uses'      => 'Anbu\\Controllers\\ProfilerController@index'
            ]
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
        $view->addNamespace('anbu', __DIR__.'/views/');
    }

    /**
     * Install the Anbu database table.
     *
     * @return void
     */
    protected function installTable()
    {
        // Get the schema builder component.
        $schema = $this->app['db']->connection()->getSchemaBuilder();

        // Check if anbu table already exists.
        if (!$schema->hasTable('anbu')) {

            // Create anbu database table.
            $schema->create('anbu', function ($table) {

                // Define fields.
                $table->increments('id');
                $table->string('uri')->nullable();
                $table->float('time')->nullable();
                $table->longText('storage');
                $table->timestamps();
            });
        }
    }
}
