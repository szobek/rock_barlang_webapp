<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['name', 'band_id', 'release_year'];
    protected $hidden = ['created_at', 'updated_at'];

    public function band()
    {
        return $this->belongsTo(Band::class, 'band_id');
    }

    public function styles() 
    {
        return $this->hasMany(Style::class, 'band_id'); 
    }
}
