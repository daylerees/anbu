<?php

namespace Anbu\Modules\Dashboard;

use Anbu\Modules\Module;
use Illuminate\Foundation\Application;

class Dashboard extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Dashboard';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'dashboard';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Welcome to Anbu. Enjoy your stay!';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'dashboard';

    /**
     * Executed after the profiled request.
     *
     * @return void
     */
    public function after()
    {
        // Bind Laravel version information.
        $this->global['version'] = Application::VERSION;
    }
}
