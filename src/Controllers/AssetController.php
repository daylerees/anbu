<?php

namespace Anbu\Controllers;

use Response;

class AssetController extends BaseController
{
    /**
     * Proxy for module assets.
     *
     * @param  string $module
     * @param  string $path
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function index($module, $path)
    {
        // Get the module from the profiler.
        $module = $this->profiler->getModule($module);

        // Check for asset existance.
        $mime = array_get($module->getAssets(), $path, false);

        // If we have a mime type.
        if ($mime) {

            // Get the module path.
            $modulePath = $module->getPath();

            // Load the asset from disk.
            $content = file_get_contents("{$modulePath}//{$path}");

            // Serve the asset with a mime type.
            return Response::make($content, 200, array('Content-Type' => $mime));

        }

        // Asset could not be found.
        return Response::make('Asset not found.', 404);
    }
}
