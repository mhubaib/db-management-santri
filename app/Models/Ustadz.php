<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ustadz extends Model
{
    /** @use HasFactory<\Database\Factories\UstadzFactory> */
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'nip',
        'spesialisasi'
    ];

    public function pelajarans(): BelongsToMany
    {
        return $this->belongsToMany(Pelajaran::class, 'pelajaran_ustadzs');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
