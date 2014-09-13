<?php

// Check to ensure function does not collide.
if(!function_exists('ad')) {

    // Define debug helper.
    function ad($value) {

        // Pass to anbu container instance.
        app('Anbu\\Profiler')->getModule('debug')->debug($value);
    }
}

if ( ! function_exists('anbu_str_limit'))
{
    // str_limit() function with some checks
    function anbu_str_limit($value)
    {
        // when value not is null or empty
        if ( ! is_null($value) && $value !== '')
        {
            $data = $value;

            // to json (object or array)
            if (is_array($value) || is_object($value))
            {
                $data = json_encode($value);
            }
            // to string (int, float, etc)
            elseif ( ! is_string($value))
            {
                $data = (string) $value;
            }

            return str_limit($data);
        }

        // when no data in value
        return '<i>No data</i>';
    }
}
