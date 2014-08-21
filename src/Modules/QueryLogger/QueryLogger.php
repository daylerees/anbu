<?php

namespace Anbu\Modules\QueryLogger;

use Anbu\Modules\Module;

class QueryLogger extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Queries';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'queries';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Log of executed SQL queries for the current request.';

    /**
     * Executed during service provider loading.
     *
     * @return void
     */
    public function register()
    {
        // Retrieve the events component.
        $event = $this->app->make('events');

        // Create buffer for query logs.
        $this->data['queries'] = [];

        // Listen for database queries.
        $event->listen('illuminate.query', [$this, 'queryEventFired']);
    }

    /**
     * Handler for database query event.
     *
     * @return void
     */
    public function queryEventFired()
    {
        // Add the query to the buffer.
        $this->data['queries'][] = func_get_args();
    }
}
