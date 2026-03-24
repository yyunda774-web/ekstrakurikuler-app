<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user dengan email yang sama jika ada
        User::where('email', 'admin@example.com')->delete();
        User::where('email', 'siswa@example.com')->delete();
        
        // Buat user admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'kelas' => 'Admin',
            'no_hp' => '081234567890',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        
        // Buat user siswa demo
        User::create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'kelas' => 'X-10',
            'no_hp' => '081234567891',
            'role' => 'siswa',
            'email_verified_at' => now(),
        ]);
        
        echo "==========================\n";
        echo "USER DEMO BERHASIL DIBUAT\n";
        echo "==========================\n";
        echo "Admin:\n";
        echo "Email: admin@example.com\n";
        echo "Password: password\n";
        echo "Role: admin\n\n";
        echo "Siswa:\n";
        echo "Email: siswa@example.com\n";
        echo "Password: password\n";
        echo "Role: siswa\n";
        echo "==========================\n";
    }
}