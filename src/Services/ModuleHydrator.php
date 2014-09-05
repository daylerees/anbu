<?php

namespace Anbu\Services;

use Anbu\Profiler;
use Anbu\Models\Storage;

class ModuleHydrator
{
    /**
     * Profiler instance.
     *
     * @var Profiler
     */
    protected $profiler;

    /**
     * Inject the anbu profiler.
     *
     * @param Profiler $profiler
     */
    public function __construct(Profiler $profiler)
    {
        // Set the profiler instance.
        $this->profiler = $profiler;
    }

    /**
     * Hydrate modules with data from storage record.
     *
     * @param  Storage $storage
     * @return void
     */
    public function hydrate(Storage $storage)
    {
        // Extract the module data from storage.
        $modules = $storage->getData();

        // Iterate module data.
        foreach ($modules as $slug => $module) {

            // Get live module from profiler.
            $m = $this->profiler->getModule($slug);

            // Set module data from storage.
            $m->setData(array_get($module, 'data'));
            $m->setGlobal(array_get($module, 'global'));
            $m->setBadge(array_get($module, 'badge'));
        }
    }
}
