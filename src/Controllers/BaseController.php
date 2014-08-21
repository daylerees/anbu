<?php

namespace Anbu\Controllers;

use App;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    /**
     * Disable profiler for own requests.
     */
    public function __construct()
    {
        // Get hold of the profiler.
        $profiler = App::make('anbu');

        // Disable the profiler.
        // This is so we don't track our own requests.
        $profiler->disable();
    }
}
