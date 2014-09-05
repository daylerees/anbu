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
        // Register clear command.
        $this->commands('Anbu\\Commands\\ClearCommand');

        // Ensure that required database table exists.
        $this->installTable();

        // Get the configuration component.
        $config = $this->app->make('config');

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
                $table->binary('storage');
                $table->timestamps();
            });
        }
    }
}
