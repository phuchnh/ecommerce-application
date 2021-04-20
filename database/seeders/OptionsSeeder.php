<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{

    protected $options = [
        'site_name' => 'site_name',
        'email_address' => 'email_address',
        'seo_meta_title' => 'seo_meta_title',
        'seo_meta_description' => 'seo_meta_description',
        'social_facebook' => 'social_facebook',
        'social_twitter' => 'social_twitter',
        'social_instagram' => 'social_instagram',
        'social_google' => 'social_google',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        option()->autoload($this->options);
    }
}
