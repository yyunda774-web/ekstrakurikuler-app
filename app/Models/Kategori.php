<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama']; // sesuaikan kolom di tabel 'kategoris'

    // Relasi ke Ekstrakurikuler (jika perlu)
    public function ekstrakurikulers()
    {
        return $this->hasMany(Ekstrakurikuler::class);
    }
}