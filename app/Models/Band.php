<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Band extends Model
{
    protected $table = 'bands';
    protected $fillable = ['name', 'description', 'formed_year'];
    protected $hidden = ['created_at', 'updated_at'];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'band_id'); 
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'band_id');
    }

    public function styles(): BelongsToMany
{
    return $this->belongsToMany(Style::class);
}
}