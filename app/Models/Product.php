<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
