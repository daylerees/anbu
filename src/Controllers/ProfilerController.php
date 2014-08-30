<?php

namespace Anbu\Controllers;

use View;
use Anbu\Models\Storage;

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
        // Get the storage record.
        $record = $this->fetchStorage($key);

        // Unserialize the storage array from the record.
        $storage = unserialize($record->storage);

        // Extract the module collection.
        $modules = array_get($storage, 'modules', []);

        // Retrieve the current module.
        $module = array_get($modules, $module, []);

        // Nest history information.
        $module['data']['history'] = $this->fetchHistory();

        // Nest the menu within the module.
        $storage['menu'] = $this->buildMenu($modules, $record->id);

        // Retrieve the child view.
        $storage['child'] = $this->renderChildView($module);

        // Embed the current module.
        $storage['current'] = $module;

        // Render the index template.
        return View::make('anbu::index', $storage);
    }

    /**
     * Fetch a storage record.
     *
     * @param  int $key
     * @return Storage
     */
    protected function fetchStorage($key)
    {
        // If we have a storage key.
        if ($key) {

            // Load the storage record using that key.
            return Storage::findOrFail($key);
        }

        // Or get the latest record.
        return Storage::orderBy('id', 'desc')->firstOrFail();
    }

    /**
     * Nest fresh history. This is a special case.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function fetchHistory()
    {
        // We want fresh history.
        return Storage::orderBy('id', 'desc')->get()->toArray();
    }

    /**
     * Render the child view for a module.
     *
     * @param  array  $module
     * @return View
     */
    protected function renderChildView(array $module)
    {
        // Add a module view namespace for this request.
        View::addNamespace('anbu_module', $module['path']);

        // Extract template.
        $template = $module['template'];

        // Return rendered template view.
        return View::make("anbu_module::{$template}", $module['data']);
    }

    /**
     * Build a side menu from the storage.
     *
     * @param  array  $modules
     * @param  int    $key
     * @return array
     */
    protected function buildMenu($modules, $key)
    {
        // Create buffer.
        $menu = [];

        // Iterate modules.
        foreach ($modules as $module) {

            // Get the slug.
            $slug = array_get($module, 'slug');

            if (array_get($module, 'inMenu', true)) {
                // Add a new menu item to the buffer.
                $menu[] = [
                    'title' => array_get($module, 'name'),
                    'slug' => $slug,
                    /**
                     * @todo Use url helper here.
                     */
                    'url' => sprintf('/anbu/%s/%s', $key, $slug),
                    'icon' => array_get($module, 'icon'),
                    'badge' => array_get($module, 'badge')
                ];
            }

        }

        // Return the menu array.
        return $menu;
    }
}
