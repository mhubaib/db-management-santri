<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'tingkatan'
    ];

    public function santri(): HasMany
    {
        return $this->hasMany(Santri::class);
    } 

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }
}
