<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    
    protected $fillable = ['name', 'band_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
