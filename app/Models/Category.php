<?php

namespace App\Models;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Category extends Model
{
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['name', 'image'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo(
            'slug'
        );
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
