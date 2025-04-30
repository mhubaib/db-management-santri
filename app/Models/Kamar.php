<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kamar extends Model
{
    /** @use HasFactory<\Database\Factories\KamarFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_kamar',
    ];
    
    public function santri(): BelongsToMany
    {
        return $this->belongsToMany(Santri::class);
    }
}
