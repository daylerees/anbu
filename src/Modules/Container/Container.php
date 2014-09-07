<?php

namespace Anbu\Modules\Container;

use Exception;
use Anbu\Modules\Module;

class Container extends Module
{
    /**
     * Format for displaying a scalar value.
     */
    const SCALAR_FORMAT = '<%s> "%s"';

    /**
     * Format for displaying a non scalar value.
     */
    const NON_SCALAR_FORMAT = '<%s>';

    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Container';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'container';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'View container bindings.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'cube';

    /**
     * Executed after the profiled request.
     *
     * @param  Symfony/Component/HttpFoundation/Request  $response
     * @param  Symfony/Component/HttpFoundation/Response $response
     * @return void
     */
    public function after($request, $response)
    {
        // Get all container bindings.
        $bindings = $this->app->getBindings();

        // Sort container bindings.
        ksort($bindings);

        // Bind bindings array to data.
        $this->data['bindings'] = $this->buildBindingsArray($bindings);

        // Set badge to binding count.
        $this->badge = count($this->data['bindings']);
    }


    protected function buildBindingsArray(array $bindings)
    {
        // Bindings array buffer.
        $rows = [];

        // Iterate binding keys.
        foreach (array_keys($bindings) as $identifier) {

            // Allow for exceptions.
            try {

                // Check if binding has already been resolved.
                $resolved = $this->app->resolved($identifier);

                // Resolve a service from the container.
                $service = $this->resolveService($identifier);

                // Create a new row.
                $rows[] = [
                    $identifier,
                    $this->getServiceDescription($service),
                    $resolved,
                    $this->calculateServiceResolutionTime($identifier)
                ];
            }
            catch (Exception $exception) {

                // Show a default row on exceptions.
                $rows[] = array($identifier, 'Unable to resolve service.', 'N/A', 'N/A');
            }
        }

        // Return buffer.
        return $rows;
    }

    /**
     * Resolve a service from the container by its identifier.
     *
     * @param  string $identifier
     * @return mixed
     */
    protected function resolveService($identifier)
    {
        return $this->app->make($identifier);
    }

    /**
     * Calculate the time to resolve a service in microseconds.
     *
     * @param  string $identifier
     * @return string
     */
    protected function calculateServiceResolutionTime($identifier)
    {
        // Set timer before.
        $before = microtime(true);

        // Resolve the service.
        $this->resolveService($identifier);

        // Calculate difference.
        return number_format((microtime(true) - $before) * 1000, 3);
    }

    /**
     * Retrieve a string representation of a service.
     *
     * @param  mixed  $service
     * @return string
     */
    protected function getServiceDescription($service)
    {
        // If the service is an object.
        if ($this->serviceIsObject($service)) {

            // Show class name.
            return get_class($service);
        }

        // Deal with other types.
        return $this->formatServiceDescription($service, is_scalar($service));
    }

    /**
     * Retrieve a suitable formatted service description.
     *
     * @param  mixed  $service
     * @param  bool   $scalar
     * @return string
     */
    protected function formatServiceDescription($service, $scalar = true)
    {
        return sprintf(

            // Decide on a format.
            $scalar ? self::SCALAR_FORMAT : self::NON_SCALAR_FORMAT,

            // Get the type.
            gettype($service),

            // Show string or nothing.
            $scalar ? (string) $service : null
        );
    }

    /**
     * Determine whether a service is an object.
     *
     * @param  mixed $service
     * @return bool
     */
    protected function serviceIsObject($service)
    {
        return gettype($service) === 'object';
    }
}
