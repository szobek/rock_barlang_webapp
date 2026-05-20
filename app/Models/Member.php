<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'band_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function band()
    {
        return $this->belongsTo(Band::class, 'band_id');
    }
}
