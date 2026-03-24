<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;

class QuickEkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {

    DB::table('ekstrakurikulers')->insert([
    'nama' => 'Voli',
    'deskripsi' => 'Ekstrakurikuler bola voli',
    'pembina' => 'Pak Andi',
    'created_at' => now(),
    'updated_at' => now(),
]);

        // Data minimal untuk testing
        $ekskul = [
            ['nama' => 'Voli', 'pembina' => 'Pak Andi'],
            ['nama' => 'Futsal', 'pembina' => 'Pak Budi'],
            ['nama' => 'PMR', 'pembina' => 'Bu Citra'],
            ['nama' => 'Tari', 'pembina' => 'Bu Dini'],
            ['nama' => 'Pramuka', 'pembina' => 'Pak Eko'],
        ];

        foreach ($ekskul as $data) {
            Ekstrakurikuler::create($data);
        }

        $this->command->info('✅ 5 data ekstrakurikuler berhasil dibuat!');
    }

    
}