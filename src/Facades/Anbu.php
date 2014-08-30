<?php

namespace Anbu\Facades;

use App;

class Anbu
{
    /**
     * Proxy static method calls to module instances.
     *
     * @param  string $method
     * @param  mixed  $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        // Resolve profiler from container.
        $profiler = App::make('anbu');

        // Return the module instance by method name.
        return $profiler->getModule($method);
    }
}
