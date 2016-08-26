<?php

namespace Anbu\Middleware;

use Closure;
use Anbu\Profiler;

class AnbuMiddleware
{
    /**
     * Resolve a profiler instance.
     *
     * @var Profiler
     */
    protected $profiler;

    /**
     * Initialise middleware.
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
        $response = $next($request);

        $this->profiler->executeAfterHook($request, $response);

        return $response;
    }

}
