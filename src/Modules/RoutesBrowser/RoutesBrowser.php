<?php

namespace Anbu\Modules\RoutesBrowser;

use Anbu\Modules\Module;

class RoutesBrowser extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Routes';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'routes';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'View a list of routes registered within the router.';
}
