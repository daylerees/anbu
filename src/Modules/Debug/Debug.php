<?php

namespace Anbu\Modules\Debug;

use Anbu\Models\Storage;
use Anbu\Modules\Module;

class Debug extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Debug';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'debug';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Debug objects outside of runtime environment.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'eye';

    /**
     * Executed during service provider loading.
     *
     * @return void
     */
    public function register()
    {
        $this->data['debugs'] = [];
    }

    /**
     * Debug an object or value.
     *
     * @return mixed
     */
    public function debug($value)
    {
        // Start output buffer.
        ob_start();

        // Var dump value.
        var_dump($value);

        // Store output buffer in array.
        $this->data['debugs'][] = ob_get_clean();
    }

    /**
     * Execute after framework request cycle.
     *
     * @return void
     */
    public function after()
    {
        $this->badge = count($this->data['debugs']);
    }
}
