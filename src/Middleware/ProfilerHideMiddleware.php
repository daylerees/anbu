<?php

namespace Anbu\Middleware;

use Closure;
use Anbu\Profiler;

class ProfilerHideMiddleware
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
     * Handle request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->profiler->hide();

        return $next($request);
    }

}
