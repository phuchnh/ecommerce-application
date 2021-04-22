<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Promotion extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
