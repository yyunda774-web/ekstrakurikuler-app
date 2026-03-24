<?php

// app/Models/Ekstrakurikuler.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ekstrakurikuler extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'pembina', 'kuota', 'hari', 'jam','kategori_id'];
    
    // Jika tabel pendaftaran bernama 'pendaftarans'
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'ekstrakurikuler_id');
    }
    
    // Atau jika tabel bernama 'pendaftaran' (singular)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'ekstrakurikuler_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class); // model Kategori ada di app/Models/Kategori.php
    }

    public function pembina()
{
    return $this->belongsTo(User::class,'pembina_id');
}


}