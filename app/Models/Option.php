<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;

class Option extends \Appstract\Options\Option
{
    /**
     * Autoload a given option value.
     *
     * @param  array|string  $key
     * @param  mixed  $value
     * @return void
     */
    public function autoload($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            self::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'autoload' => true]
            );
            Config::set('options.'.$key, $value);
        }
    }
}
