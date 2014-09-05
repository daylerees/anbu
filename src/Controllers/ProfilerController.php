<?php

namespace Anbu\Controllers;

use View;
use Exception;
use Anbu\Modules\Module;
use Anbu\Models\Storage;
use Anbu\Services\MenuBuilder;

class ProfilerController extends BaseController
{
    /**
     * Show the profiler.
     *
     * @param  int    $key
     * @param  string $module
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function index($key = null, $module = 'dashboard')
    {
        try {

            // Get a storage record from the repository.
            $record = $this->repository->get($key);

        } catch (Exception $exception) {

            // On failure show the error page.
            return View::make('anbu::error');
        }

        // Hydrate modules from storage.
        $this->hydrator->hydrate($record);

        // Get the current module.
        $module = $this->profiler->getModule($module);

        // Get the profiler view data.
        $data = $this->buildViewData($record, $module);

        // Render the profiler template.
        return View::make('anbu::index', $data);
    }

    /**
     * Build the profiler view data array.
     *
     * @param  Storage $record
     * @param  Module  $module
     * @return array
     */
    protected function buildViewData(Storage $record, Module $module)
    {
        // Get global data array.
        $data = $this->getGlobalData($record);

        // Nest the child view.
        array_set($data, 'child', $this->renderModule($module));

        // Nest current module
        array_set($data, 'current', $module);

        // Return view data array.
        return $data;
    }

    /**
     * Get the global data collection.
     *
     * @param  Storage $record
     * @return array
     */
    protected function getGlobalData(Storage $record)
    {
        // Global data buffer.
        $global = [];

        // Get the live module array.
        $modules = $this->profiler->getModules();

        // Iterate modules.
        foreach ($modules as $module) {

            // Extract global data from module.
            $data = $module->getGlobal();

            // Merge with global data array.
            $global = array_merge($data, $global);
        }

        // Nest the menu into the global data.
        $global['menu'] = with(new MenuBuilder)->build($modules, $record->id);

        // Return global data.
        return $global;
    }

    /**
     * Render the child view for a module.
     *
     * @param  Module $module
     * @return View
     */
    protected function renderModule(Module $module)
    {
        // Add a module view namespace for this request.
        View::addNamespace('anbu_module', $module->getPath());

        // Execute live module hook.
        $module->live();

        // Extract template name.
        $template = $module->getTemplate();

        // Return rendered template view.
        return View::make("anbu_module::{$template}", $module->getData());
    }
}
