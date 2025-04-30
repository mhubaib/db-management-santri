<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'tingkatan'
    ];

    public function santri(): BelongsToMany
    {
        return $this->belongsToMany(Santri::class);
    }

    public function jadwal(): BelongsToMany
    {
        return $this->belongsToMany(Jadwal::class);
    } 
}
