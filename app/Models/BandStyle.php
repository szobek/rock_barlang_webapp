<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BandStyle extends Model
{
    protected $table = 'band_style';
    protected $fillable = ['band_id', 'style_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
