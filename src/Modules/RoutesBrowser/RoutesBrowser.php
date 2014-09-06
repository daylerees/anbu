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

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'road';

    /**
     * Executed after the profiled request.
     *
     * @param  Symfony/Component/HttpFoundation/Request  $response
     * @param  Symfony/Component/HttpFoundation/Response $response
     * @return void
     */
    public function after($request, $response)
    {
        // Get hold of the router component.
        $router = $this->app->make('router');

        // Get the request.
        $request = $this->app->make('request');

        // Retrieve the collection of routes.
        $routeCollection = $router->getRoutes()->getRoutes();

        // Iterate route collection.
        foreach ($routeCollection as $route) {

            // Add a new route to the data array.
            $this->data['routes'][] = [
                $route->getMethods(),                               // HTTP Verb
                $this->highlightParams($route->getPath()),          // URI
                $route->getActionName()                             // Action
            ];
        }

        // Get the current route.
        $current = $router->current();

        // Set the current route information.
        $this->data['current'] = [
            $request->method(),                               // HTTP Verb
            $this->highlightParams($current->getPath()),      // URI
            $current->getActionName()                         // Action
        ];

        // Set badge to number of registered routes.
        $this->badge = count($this->data['routes']);
    }

    /**
     * Highlight parameters in URI paths.
     *
     * @param  string $uri
     * @return string
     */
    public function highlightParams($uri)
    {
        return preg_replace('/(\{.*?\})/', '<span class="parameter">$1</span>', $uri);
    }
}
