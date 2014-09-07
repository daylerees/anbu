<?php

namespace Anbu\Modules\Info;

use Anbu\Modules\Module;

class Info extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Info';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'info';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'PHP environmental information.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'info-circle';

    /**
     * Executed during the profiler request cycle.
     *
     * @return void
     */
    public function live()
    {
        // Start output buffer.
        ob_start();

        // Execute PHP info function.
        phpinfo();

        // Capture buffer contents.
        $info = ob_get_contents();

        // Clear the buffer.
        ob_end_clean();

        // We only want the body.
        $info = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $info);

        // Store in data array.
        $this->data['info'] =  $info;
    }
}
