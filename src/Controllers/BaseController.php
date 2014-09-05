<?php

namespace Anbu\Controllers;

use Anbu\Profiler;
use Anbu\Repositories\Repository;
use Anbu\Services\ModuleHydrator;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    /**
     * Profiler instance.
     *
     * @var Profiler
     */
    protected $profiler;

    /**
     * Repository instance.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Hydrator instance.
     *
     * @var ModuleHydrator
     */
    protected $hydrator;

    /**
     * Disable profiler for own requests.
     *
     * @param  Profiler        $profiler
     * @param  Repository      $repository
     * @param  ModuleHydrator  $hydrator
     */
    public function __construct(
        Profiler        $profiler,
        Repository      $repository,
        ModuleHydrator  $hydrator
    ) {
        // Don't track our own requests.
        $profiler->disable();

        // Set injected properties.
        $this->profiler     = $profiler;
        $this->repository   = $repository;
        $this->hydrator     = $hydrator;
    }
}
