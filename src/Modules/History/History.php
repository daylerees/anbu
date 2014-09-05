<?php

namespace Anbu\Modules\History;

use Anbu\Modules\Module;
use Anbu\Repositories\Repository;
use Illuminate\Foundation\Application;

class History extends Module
{
    /**
     * Storage repository instance.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'History';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'history';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Browse previous requests to the application.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'history';

    /**
     * Inject the storage repository.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        // Bind repository to class property.
        $this->repository = $repository;
    }

    /**
     * Executed after the profiled request.
     *
     * @return void
     */
    public function after()
    {
        // Bind the current URI to global data.
        $this->global['uri'] = $this->getCurrentRequestUri();
    }

    /**
     * Executed during the profiler request cycle.
     *
     * @return void
     */
    public function live()
    {
        // Bind all requests to data array.
        $this->data['history'] = $this->repository->all();
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

}
