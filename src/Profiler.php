<?php

namespace Anbu;

use Anbu\Modules\Module;
use Anbu\Models\Storage;
use Anbu\Repositories\Repository;
use Illuminate\Foundation\Application;
use Anbu\Exceptions\InvalidModuleException;

class Profiler
{
    /**
     * Anbu version number.
     */
    const VERSION = 'ALPHA';

    /**
     * Laravel application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Set the storage repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Registered Anbu modules.
     *
     * @var array
     */
    protected $modules = [];

    /**
     * Enable profiling?
     *
     * @var boolean
     */
    protected $enabled = true;

    /**
     * Render the profiler link?
     *
     * @var boolean
     */
    protected $display = true;

    /**
     * Default modules to load.
     *
     * @var array
     */
    protected $defaultModules = [
        'Anbu\Modules\Dashboard\Dashboard',
        'Anbu\Modules\RoutesBrowser\RoutesBrowser',
        'Anbu\Modules\Request\Request',
        'Anbu\Modules\QueryLogger\QueryLogger',
        'Anbu\Modules\Logger\Logger',
        'Anbu\Modules\Events\Events',
        /*'Anbu\Modules\Container\Container',*/
        'Anbu\Modules\Debug\Debug',
        'Anbu\Modules\Timers\Timers',
        'Anbu\Modules\Info\Info',
        'Anbu\Modules\History\History'
    ];

    /**
     * Inject the storage repository.
     *
     * @param  Repository $repository
     */
    public function __construct(Repository $repository)
    {
        // Set the storage repository.
        $this->repository = $repository;
    }

    /**
     * Register Anbu profiler modules.
     *
     * @param  Application $app
     * @return void
     */
    public function registerModules(Application $app)
    {
        // Set application instance.
        $this->app = $app;

        // Get list of modules.
        $modules = $this->getModuleList();

        // Iterate available modules.
        foreach ($modules as $module) {

            // Trigger registration of Anbu modules.
            $this->registerModule($module);
        }
    }

    /**
     * Retrieve list of available modules.
     *
     * @return array
     */
    protected function getModuleList()
    {
        // Retrieve configuration component.
        $config = $this->app->make('config');

        // Get additional anbu modules.
        $modules = $config->get('anbu.modules', []);

        // Return merged module collection.
        return array_merge($modules, $this->getDefaultModules());
    }

    /**
     * Default module array.
     *
     * @return array
     */
    protected function getDefaultModules()
    {
        return $this->defaultModules;
    }

    /**
     * Set the default modules to load.
     *
     * @param array $defaultModules
     */
    public function setDefaultModules($defaultModules)
    {
        $this->defaultModules = $defaultModules;
    }

    /**
     * Register an Anbu profiler module.
     *
     * @param  string $module
     * @return void
     */
    protected function registerModule($module)
    {
        // Resolve module through container.
        $module = $this->app->make($module);

        // Determine if module is valid.
        if (!$module instanceof Module) {

            // If not, throw runtime exception.
            throw new InvalidModuleException;
        }

        // Share application instance with module.
        $module->setApplication($this->app);

        // Trigger module registration hook.
        $module->before();

        // Add to module collection.
        $this->modules[$module->getSlug()] = $module;
    }

    /**
     * Execute hooks after the frameworks request cycle.
     *
     * @param  Symfony/Component/HttpFoundation/Request  $response
     * @param  Symfony/Component/HttpFoundation/Response $response
     * @return void
     */
    public function executeAfterHook($request, $response)
    {
        // If the profiler is disabled...
        if (!$this->enabled) {

            // Exit, we don't want to log requests to the profiler.
            return;
        }

        // Execute the after hook for each module.
        $this->executeModuleAfterHooks($request, $response);

        // Store the module and return it.
        $storage = $this->storeModuleData();

        // Get content type header.
        $type = $response->headers->get('Content-Type');

        // Check for JSON in the header.
        if (strstr($type, 'text/html') && $this->display && !$response->isRedirection()) {

            // Get the view component.
            $view = $this->app->make('view');

            // Get the response content.
            $content = $response->getContent();

            // Append button to response.
            $content .= $view->make('anbu::button', compact('storage'));

            // Replace the old content.
            $response->setContent($content);
        }
    }

    /**
     * Storage module data using the repository.
     *
     * @return Storage
     */
    protected function storeModuleData()
    {
        // Create new storage record.
        $storage = new Storage;

        // Store the current URI.
        $storage->uri = $this->getCurrentRequestUri();

        // Set the request time.
        $storage->time = microtime(true) - LARAVEL_START;

        // Fetch module storage array and set on record.
        $storage->storage = base64_encode(serialize($this->fetchStorage()));

        // Use the repository to save the storage.
        $this->repository->put($storage);

        // Return the storage object.
        return $storage;
    }

    /**
     * Get the URI for the current request.
     *
     * @return string
     */
    protected function getCurrentRequestUri()
    {
        // Get the routing component.
        $current = $this->app->make('router')->current();

        // Get the current request.
        $request = $this->app->make('request');

        // Return the current request.
        return "{$request->method()} {$current->getPath()}";
    }

    /**
     * Execute the after hook for active modules.
     *
     * @param  Symfony/Component/HttpFoundation/Request  $response
     * @param  Symfony/Component/HttpFoundation/Response $response
     * @return void
     */
    protected function executeModuleAfterHooks($request, $response)
    {
        // Iterate modules.
        foreach ($this->modules as $module) {

            // Fire after hook.
            $module->after($request, $response);
        }
    }

    /**
     * Fetch the data to be stored for each module.
     *
     * @return array
     */
    protected function fetchStorage()
    {
        // Create storage buffer.
        $storage = [];

        // Iterate modules.
        foreach ($this->modules as $module) {

            // Get the module slug.
            $slug = $module->getSlug();

            // Fire after hook.
            $storage[$slug] = $module->getStorage();
        }

        return $storage;
    }

    /**
     * Dsiable the profiler for this request.
     *
     * @return void
     */
    public function disable()
    {
        $this->enabled = false;
    }

    /**
     * Disable showing the profiler link on current request.
     *
     * @return void
     */
    public function hide()
    {
        $this->display = false;
    }

    /**
     * Get the collection of modules.
     *
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Retrieve a module by its slug.
     *
     * @param  string $module
     * @return mixed
     */
    public function getModule($module)
    {
        return $this->modules[$module];
    }
}
