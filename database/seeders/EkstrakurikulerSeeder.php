<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $ekskulList = [
            [
                'nama' => 'PMR',
                'deskripsi' => 'Palang Merah Remaja',
                'pembina' => 'SESINIA RENDI LAUREN',
                'kuota' => 30,
                'hari' => 'Rabu',
                'waktu' => '15.30 - 17.30 WIB',
                'jam' => '15.30 - 17.30 WIB'
            ],
            [
                'nama' => 'PA',
                'deskripsi' => 'Persekutuan Doa',
                'pembina' => 'PURNA WIRAWAN',
                'kuota' => 35,
                'hari' => 'Kamis',
                'waktu' => '14.30 - 16.30 WIB',
                'jam' => '14.30 - 16.30 WIB'
            ],
            [
                'nama' => 'FUTSAL',
                'deskripsi' => 'Ekstrakurikuler futsal',
                'pembina' => 'ADE',
                'kuota' => 18,
                'hari' => 'Senin & Rabu',
                'waktu' => '16.00 - 18.00 WIB',
                'jam' => '16.00 - 18.00 WIB'
            ],
            [
                'nama' => 'PIK-R',
                'deskripsi' => 'Pusat Informasi Konseling Remaja',
                'pembina' => 'RILAN ULUNG WINANGSIT',
                'kuota' => 30,
                'hari' => 'Rabu & Jumat',
                'waktu' => '14.00 - 16.00 WIB',
                'jam' => '14.00 - 16.00 WIB'
            ],
            [
                'nama' => 'PRAMUKA',
                'deskripsi' => 'Praja Muda Karana',
                'pembina' => 'RISKI AKBAR RISIKA',
                'kuota' => 50,
                'hari' => 'Sabtu',
                'waktu' => '08.00 - 12.00 WIB',
                'jam' => '08.00 - 12.00 WIB'
            ],
            [
                'nama' => 'ROHIS',
                'deskripsi' => 'Rohani Islam',
                'pembina' => 'TANWIRUL MUSTAFID',
                'kuota' => 40,
                'hari' => 'Jumat',
                'waktu' => '13.30 - 15.30 WIB',
                'jam' => '13.30 - 15.30 WIB'
            ],
            [
                'nama' => 'BOXING',
                'deskripsi' => 'Olahraga tinju',
                'pembina' => 'TRUBUS',
                'kuota' => 20,
                'hari' => 'Selasa & Kamis',
                'waktu' => '15.00 - 17.00 WIB',
                'jam' => '15.00 - 17.00 WIB'
            ],
            [
                'nama' => 'TARI',
                'deskripsi' => 'Seni tari tradisional',
                'pembina' => 'ELA',
                'kuota' => 25,
                'hari' => 'Selasa & Jumat',
                'waktu' => '14.00 - 16.00 WIB',
                'jam' => '14.00 - 16.00 WIB'
            ],
            [
                'nama' => 'VOLLY',
                'deskripsi' => 'Olahraga bola voli',
                'pembina' => 'HEVEA HARESTU',
                'kuota' => 20,
                'hari' => 'Senin & Kamis',
                'waktu' => '15.00 - 17.00 WIB',
                'jam' => '15.00 - 17.00 WIB'
            ],
            [
                'nama' => 'SEPAK BOLA',
                'deskripsi' => 'Olahraga sepak bola',
                'pembina' => 'ADE',
                'kuota' => 22,
                'hari' => 'Rabu & Jumat',
                'waktu' => '16.00 - 18.00 WIB',
                'jam' => '16.00 - 18.00 WIB'
            ],
            [
                'nama' => 'SILAT',
                'deskripsi' => 'Pencak silat',
                'pembina' => 'SUDIN',
                'kuota' => 22,
                'hari' => 'Senin & Jumat',
                'waktu' => '16.00 - 18.00 WIB',
                'jam' => '16.00 - 18.00 WIB'
            ],
            [
                'nama' => 'BAND',
                'deskripsi' => 'Ekstrakurikuler band musik',
                'pembina' => 'PURNAWIRAWAN',
                'kuota' => 15,
                'hari' => 'Kamis',
                'waktu' => '15.00 - 17.00 WIB',
                'jam' => '15.00 - 17.00 WIB'
            ],
            [
                'nama' => 'TONTI',
                'deskripsi' => 'Tonjong Tinggi (PBB / Drum Band)',
                'pembina' => 'SAEFUDIN',
                'kuota' => 25,
                'hari' => 'Selasa & Kamis',
                'waktu' => '15.00 - 17.00 WIB',
                'jam' => '15.00 - 17.00 WIB'
            ],
        ];

        foreach ($ekskulList as $ekskul) {
            Ekstrakurikuler::create($ekskul);
        }

        $this->command->info('Data ekstrakurikuler berhasil ditambahkan!');
    }
}