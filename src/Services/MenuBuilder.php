<?php

namespace Anbu\Services;

class MenuBuilder
{
    /**
     * Main menu array.
     *
     * @var array
     */
    protected $menu = [];

    /**
     * Build a menu from a module array.
     *
     * @param  array  $modules
     * @param  string $key
     * @return array
     */
    public function build(array $modules, $key)
    {
        // Iterate modules.
        foreach ($modules as $module) {

            // If the module should be in the menu.
            if ($module->inMenu()) {

                // Add the menu item.
                $this->menu[] = $module->getMenuItem($key);
            }
        }

        // Return the menu array.
        return $this->menu;
    }
}
