<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['album_neve', 'egyuttes_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
