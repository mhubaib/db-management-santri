<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    /** @use HasFactory<\Database\Factories\KamarFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_kamar',
    ];
    
    public function santri(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
}
