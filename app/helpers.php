<?php
if (!function_exists('option')) {
    /**
     * Get the specified option value.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function option($key, $default = null)
    {
        return Option::get($key, $default);
    }
}
