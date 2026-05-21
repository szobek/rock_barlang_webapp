<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'url',
        'description',
        'band_id',
        'album_id'
    ];
    public function band()
    {
        return $this->belongsTo(Band::class, 'band_id');
    }
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
