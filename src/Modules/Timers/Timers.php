<?php

namespace Anbu\Modules\Timers;

use Anbu\Modules\Module;

class Timers extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Timers';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'timers';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Custom timers, useful for application profiling.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'clock-o';

    /**
     * Array of microsecond start times for timers.
     *
     * @var array
     */
    protected $startTimes = [];

    /**
     * Executed before the profiled request.
     *
     * @return void
     */
    public function before()
    {
        // Set timers array.
        $this->data['times'] = [];
    }

    /**
     * Start a profile timer.
     *
     * @param  mixed $key
     * @return void
     */
    public function start($key)
    {
        // Add start microtime to start times array.
        $this->startTimes[$key] = microtime(true);
    }

    /**
     * End a profile timer.
     *
     * @param  mixed  $key
     * @param  string $comment
     * @return
     */
    public function end($key, $comment = null)
    {
        // Calculate end microtime.
        $end = microtime(true);

        // Retrieve start microtime.
        $start = $this->startTimes[$key];

        // If we don't have a start.
        if (!$start) {

            // Get out of here.
            return;
        }

        // Calculate the duration in microseconds.
        $duration = $end - $start;

        // Add the completed time sequence to the data array.
        $this->data['times'][] = compact('key', 'start', 'end', 'duration', 'comment');
    }

    /**
     * Executed after the profiled request.
     *
     * @return void
     */
    public function after()
    {
        $this->badge = count($this->data['times']);
    }
}
