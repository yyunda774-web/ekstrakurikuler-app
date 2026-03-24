<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kelas',
        'no_hp',
        'ekstrakurikuler_id',
        'kode_pendaftaran',
        'status',
        'keterangan',
        'tanggal_verifikasi',
        'admin_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'tanggal_verifikasi' => 'datetime',
    ];

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}