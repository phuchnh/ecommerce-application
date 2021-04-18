<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{

    protected $options = [
        ['key' => 'site_name', 'value' => ''],
        ['key' => 'email_address', 'value' => ''],
        ['key' => 'seo_meta_title', 'value' => ''],
        ['key' => 'seo_meta_description', 'value' => ''],
        ['key' => 'social_facebook', 'value' => ''],
        ['key' => 'social_twitter', 'value' => ''],
        ['key' => 'social_instagram', 'value' => ''],
        ['key' => 'social_google', 'value' => '']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }
}
