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
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'database';

    /**
     * SQL keywords to highlight.
     *
     * @var array
     */
    protected $keywords = [
        'create',
        'from',
        'where',
        'select'
    ];

    /**
     * Executed before the profiled request.
     *
     * @return void
     */
    public function before()
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
        // Get the arguments.
        $args = func_get_args();

        // Highlight SQL terms.
        $args[0] = $this->highlightQuery($args[0]);

        // Add the query to the buffer.
        $this->data['queries'][] = $args;
    }

    /**
     * Highlight the executed query.
     *
     * @param  string $query
     * @return string
     */
    protected function highlightQuery($query)
    {
        // Iterate keywords.
        foreach ($this->keywords as $keyword) {

            // Wrap keywords in tag.
            $query = preg_replace("/({$keyword})/", '<span class="sql-keyword">$1</span>', $query);
        }

        // Wrap values in a tag.
        $query = preg_replace('/\`(.*?)\`/', '`<span class="sql-value">$1</span>`', $query);

        // Return query string.
        return $query;
    }

    /**
     * Executed after the profiled request.
     *
     * @param  Symfony/Component/HttpFoundation/Request  $response
     * @param  Symfony/Component/HttpFoundation/Response $response
     * @return void
     */
    public function after($request, $response)
    {
        $this->badge = count($this->data['queries']);
    }
}
