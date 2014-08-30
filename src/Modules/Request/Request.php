<?php

namespace Anbu\Modules\Request;

use Anbu\Modules\Module;

class Request extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Request';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'request';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'View server environmental variables.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'refresh';

    /**
     * Execute after framework request cycle.
     *
     * @return void
     */
    public function after()
    {
        // Get the request component from the container.
        $input = $this->app->make('request');

        // Dump all request data into the class data array.
        $this->data['request'] = $input->all();

        // Place environmental variables into data array.
        $this->data['server'] = $input->server();

        // Place request headers in the data array.
        $this->data['headers'] = $input->header();
    }
}
