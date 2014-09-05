<?php

namespace Anbu\Modules\Logger;

use Anbu\Modules\Module;

class Logger extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Logger';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'logger';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Logged messages for this request.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'align-left';

    /**
     * Executed before the profiled request.
     *
     * @return void
     */
    public function before()
    {
        // Retrieve the events compontent.
        $event = $this->app->make('events');

        // Create a buffer for logs.
        $this->data['logs'] = [];

        // Listen for logging events.
        $event->listen('illuminate.log', [$this, 'logEventFired']);
    }

    /**
     * Handler for logging events.
     *
     * @return void
     */
    public function logEventFired()
    {
        // Add log to buffer.
        $this->data['logs'][] = func_get_args();
    }

    /**
     * Executed after the profiled request.
     *
     * @return void
     */
    public function after()
    {
        // Set badge to number of logs.
        $this->badge = count($this->data['logs']);
    }
}
