<?php

namespace Anbu\Modules\History;

use Anbu\Models\Storage;
use Anbu\Modules\Module;

class History extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'History';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'history';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'Browse previous requests to the application.';

    /**
     * Icon for side menu.
     *
     * @var string
     */
    protected $icon = 'history';
}
