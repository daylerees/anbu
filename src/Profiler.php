<?php

namespace Anbu;

use Anbu\Modules\Module;
use Anbu\Models\Storage;
use Illuminate\Foundation\Application;
use Anbu\Exceptions\InvalidModuleException;

class Profiler
{
    /**
     * Laravel application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Registered Anbu modules.
     *
     * @var array
     */
    protected $modules = [];

    /**
     * Is the profiler enabled?
     *
     * @var boolean
     */
    protected $enabled = true;

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
        return [
            'Anbu\Modules\Dashboard\Dashboard',
            'Anbu\Modules\RoutesBrowser\RoutesBrowser',
            'Anbu\Modules\QueryLogger\QueryLogger',
            'Anbu\Modules\Logger\Logger',
            'Anbu\Modules\History\History',
        ];
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
        $module->register();

        // Add to module collection.
        $this->modules[] = $module;
    }

    /**
     * Register event listeners for the profiler.
     *
     * @return void
     */
    public function registerListeners()
    {
        // Bind the after event.
        $this->app->after([$this, 'executeAfterHook']);
    }

    /**
     * Execute hooks after the frameworks request cycle.
     *
     * @return void
     */
    public function executeAfterHook()
    {
        // If the profiler is disabled...
        if (!$this->isEnabled()) {

            // Exit, we don't want to log requests to the profiler.
            return;
        }
        // Execute the after hook for each module.
        $this->executeModuleAfterHooks();

        // Create new storage record.
        $storage = new Storage;

        // Fetch module storage array and set on record.
        $storage->storage = serialize($this->fetchStorage());

        // Save record.
        $storage->save();
    }

    /**
     * Execute the after hook for active modules.
     *
     * @return void
     */
    protected function executeModuleAfterHooks()
    {
        // Iterate modules.
        foreach ($this->modules as $module) {

            // Fire after hook.
            $module->after();
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
     * Determine whether the profiler is enabled.
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enable the profiler for this request.
     *
     * @return void
     */
    public function enable()
    {
        $this->enabled = true;
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
}
