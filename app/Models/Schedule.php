<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['day', 'opens_at', 'closes_at'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
