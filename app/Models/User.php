<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas',
        'no_hp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ==================== RELATIONSHIPS ====================
    
    /**
     * Get all pendaftaran for the user.
     */
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'user_id');
    }

    // ==================== ACCESSORS ====================
    
    /**
     * Check if user is admin (accessor).
     * Usage: $user->is_admin
     */
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is siswa (accessor).
     * Usage: $user->is_siswa
     */
    public function getIsSiswaAttribute()
    {
        return $this->role === 'siswa';
    }

    // ==================== SCOPES ====================
    
    /**
     * Scope untuk mendapatkan hanya siswa.
     */
    public function scopeSiswa($query)
    {
        return $query->where('role', 'siswa');
    }

    /**
     * Scope untuk mendapatkan hanya admin.
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    // ==================== METHODS ====================
    
    /**
     * Check if user is admin (method alternative).
     * Usage: $user->isAdmin()
     */
    public function isAdmin()
    {
        return $this->is_admin; // Menggunakan accessor
    }

    /**
     * Check if user is siswa (method alternative).
     * Usage: $user->isSiswa()
     */
    public function isSiswa()
    {
        return $this->is_siswa; // Menggunakan accessor
    }

    /**
     * Get user role in Indonesian.
     */
    public function getRoleIndoAttribute()
    {
        return $this->role === 'admin' ? 'Administrator' : 'Siswa';
    }

    /**
     * Get formatted phone number.
     */
    public function getFormattedPhoneAttribute()
    {
        if (empty($this->no_hp)) return '-';
        
        $phone = preg_replace('/[^0-9]/', '', $this->no_hp);
        if (strlen($phone) > 10) {
            return '+62 ' . substr($phone, 0, 3) . '-' . substr($phone, 3, 4) . '-' . substr($phone, 7);
        }
        
        return $this->no_hp;
    }

    public function ekskulYangDibina()
{
    return $this->hasMany(Ekstrakurikuler::class,'pembina_id');
}
}