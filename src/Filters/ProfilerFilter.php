<?php

namespace Anbu\Filters;

use Anbu\Profiler;

class ProfilerFilter
{
    /**
     * Resolve a profiler instance.
     *
     * @var Profiler
     */
    protected $profiler;

    /**
     * Inject profiler instance.
     *
     * @param Profiler $profiler
     */
    public function __construct(Profiler $profiler)
    {
        $this->profiler = $profiler;
    }

    /**
     * Execute the filter to disable the anbu button.
     *
     * @return void
     */
    public function hide()
    {
        $this->profiler->hide();
    }

    /**
     * Execute the filter to disable anbu.
     *
     * @return void
     */
    public function disable()
    {
        $this->profiler->disable();
    }
}
