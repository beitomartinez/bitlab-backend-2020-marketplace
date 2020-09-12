<?php

namespace App\Models;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Business extends Model
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'whatsapp',
        'email',
        'website',
        'address',
        'is_delivery',
        'is_takeout',
        'city_id',
        'state_id',
        'category_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo(
            'slug'
        );
    }


    /* RELATIONSHIP */

    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
