<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create sample siswa
        User::create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'nis' => '2024001',
            'kelas' => 'XII IPA 1',
            'no_hp' => '081234567890'
        ]);

        // Create sample ekstrakurikuler
        Ekstrakurikuler::create([
            'nama' => 'Paskibra',
            'deskripsi' => 'Ekstrakurikuler Paskibra untuk melatih kedisiplinan dan cinta tanah air',
            'pembina' => 'Budi Santoso, S.Pd',
            'kuota' => 30,
            'hari' => 'Senin dan Kamis',
            'waktu' => '15:30'
        ]);

        Ekstrakurikuler::create([
            'nama' => 'Futsal',
            'deskripsi' => 'Ekstrakurikuler Futsal untuk mengembangkan bakat olahraga',
            'pembina' => 'Andi Wijaya, S.Pd',
            'kuota' => 20,
            'hari' => 'Selasa dan Jumat',
            'waktu' => '16:00'
        ]);

        Ekstrakurikuler::create([
            'nama' => 'Paduan Suara',
            'deskripsi' => 'Ekstrakurikuler seni musik dan vokal',
            'pembina' => 'Siti Rahayu, S.Sn',
            'kuota' => 25,
            'hari' => 'Rabu',
            'waktu' => '15:00'
        ]);
    }
}