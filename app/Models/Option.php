<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $casts = [
        'value' => 'json'
    ];

    protected $fillable = [
        'key',
        'value',
        'autoload'
    ];

    /**
     * Get the specified option value.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ($option = self::where('key', $key)->first()) {
            return $option->get('value');
        }
        return $default;
    }

    /**
     * Set a given option value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @param  boolean  $autoload
     * @return void
     */
    public function set($key, $value = null, $autoload = false)
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        if ($autoload) {

        }
    }

    /**
     * Remove/delete the specified option value.
     *
     * @param  string  $key
     * @return bool
     */
    public function remove($key)
    {
        return (bool) self::where('key', $key)->delete();
    }
}
