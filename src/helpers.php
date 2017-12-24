<?php

use Eskirex\Component\Dotify\Dotify;

if (!function_exists('dotify')) {
    /**
     * Dotify constructor helper
     *
     * @param array|string|Dotify $array
     * @return Dotify
     */
    function dotify($array = null): Dotify
    {
        return new Dotify($array);
    }
}
