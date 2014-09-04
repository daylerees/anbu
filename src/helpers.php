<?php

// Check to ensure function does not collide.
if(!function_exists('ad')) {

    // Define debug helper.
    function ad($value) {

        // Pass to anbu container instance.
        app('anbu')->getModule('debug')->debug($value);
    }
}
