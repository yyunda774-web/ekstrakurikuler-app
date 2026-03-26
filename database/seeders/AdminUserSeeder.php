<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@ekstrakurikuler.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'phone' => '085878282854'
            ],
            [
                'name' => 'Siswa Demo',
                'email' => 'siswa@gmail.com',
                'password' => '$2y$12$3ImAXlKLYjJrDybSfT.klOqBSu2gdn265fuRpxMmnsxHkdeyv9zCO',
                'role' => 'siswa'
            ],
            [
                'name' => 'Pembina Silat',
                'email' => 'pembina.silat@gmail.com',
                'password' => '$2y$12$8SANUkHZJVvvLcVsBki/ZO4e6T19D8fDXIK5fZw.4D9AXti1R0AxO',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina PMR',
                'email' => 'pmr@guru.com',
                'password' => '$2y$12$QdjvMrCX5P4dQMvdWhToaO22oomo6Og7e0kDfNwup9oX9LzMu4hxy',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Futsal',
                'email' => 'futsal@guru.com',
                'password' => '$2y$12$MwD5k3sVVX7ltHBqzdZFs.sTJrtL8/jk8Jkgpqs2UD//n9OCM6Yc.',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina PA',
                'email' => 'pembina.pa@sekolah.com',
                'password' => '$2y$12$77k3WsMCOaYuALb12Lummur7y9M.snRtClJEQ6u.7ugJeQSaYI2A.',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Pramuka',
                'email' => 'pembina.pramuka@sekolah.com',
                'password' => '$2y$12$AxT6iYD2YEfRIg0YnqiPKuWJJmsnpLT6uvBl41BpOIIgubY/r4QE2',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Boxing',
                'email' => 'pembina.boxing@sekolah.com',
                'password' => '$2y$12$Iojp4H7f3sb6ZNCnqgOdJegSMcK3fAoUH0AorXnFSTeR/D2rHWiqC',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Tari',
                'email' => 'pembina.tari@sekolah.com',
                'password' => '$2y$12$LyNhd5dmiJ3.DMiH.sDCq.UBKDXrhls7JxzjNMMzvXFjnq1ScOnfC',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Volly',
                'email' => 'pembina.volly@sekolah.com',
                'password' => '$2y$12$rIGj8G7IHK4NRLZ7PB4XfeTLyf53n1z/7ZQDGxk18ZtiBHWA8/Yn6',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Sepak Bola',
                'email' => 'pembina.sepakbola@sekolah.com',
                'password' => '$2y$12$lBgJv/BgCaMe.4tBLgYJ.elig06d7bwRPt7QQBw6Y58wvD2Tb4DWK',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Band',
                'email' => 'pembina.band@sekolah.com',
                'password' => '$2y$12$jXzETPLRSMSsfggwXcDCKOSL4G6PnqtAYYIB4dKC0z40v/Cv5Jmbq',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Tonti',
                'email' => 'pembina.tonti@sekolah.com',
                'password' => '$2y$12$2j.5dTnrhiNF9t4sMiGcG.iBkU0qhuuyLjD.wxDT3l.DcVt9H3EjS',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina PIK-R',
                'email' => 'pembina.pikr@sekolah.com',
                'password' => '$2y$12$PQlr5giU.umo.tJTCqvnBO.YY7buUYHBSHq7FLO2CzY268Z5MJaqS',
                'role' => 'pembina'
            ],
            [
                'name' => 'Pembina Rohis',
                'email' => 'pembina.rohis@sekolah.com',
                'password' => '$2y$12$bNdRDn9E9C07/5eSC.670Oaie9X2LZdxfOMopUm2uk654ZFdYVAjS',
                'role' => 'pembina'
            ],
        ]);
    }
}