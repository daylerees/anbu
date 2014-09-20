<?php

namespace Anbu\Modules\Events;

use Anbu\Modules\Module;

class Events extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Events';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'events';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'List of fired events.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'exclamation-circle';

    /**
     * Executed before the profiled request.
     *
     * @return void
     */
    public function before()
    {
        // Initialize array.
        $this->data['events'] = [];

        // Get the events system.
        $event = $this->app->make('events');

        // Bind handler for all events.
        $event->listen('*', [$this, 'eventFired']);
    }

    /**
     * Log fired events.
     *
     * @return void
     */
    public function eventFired()
    {
        // Get the events system.
        $event = $this->app->make('events');

        // Add the event to the data array.
        $this->data['events'][] = [
            'name' => $event->firing(),
            'time' => microtime(true) - LARAVEL_START
        ];
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
        $this->badge = count($this->data['events']);
    }
}
