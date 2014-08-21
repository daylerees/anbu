<?php

namespace Anbu\Controllers;

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
        /**
         * @todo Allow asset proxy.
         */
        echo 'Asset here!';
    }
}
