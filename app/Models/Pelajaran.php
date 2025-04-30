<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelajaran extends Model
{
    /** @use HasFactory<\Database\Factories\PelajaranFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_pelajaran',
        'kode_pelajaran',
    ];
    public function ustadzs(): BelongsToMany
    {
        return $this->belongsToMany(Ustadz::class, 'pelajaran_ustadzs');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
