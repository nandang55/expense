<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'nik' => '1234567890123456',
                'name' => 'Ahmad Wijaya',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'address' => 'Jl. Merdeka No. 123',
                'rt' => '01',
                'rw' => '05',
                'village' => 'Kemayoran',
                'subdistrict' => 'Kemayoran',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'postal_code' => '10610',
                'phone' => '081234567890',
                'email' => 'ahmad.wijaya@email.com',
                'religion' => 'islam',
                'marital_status' => 'married',
                'occupation' => 'Wiraswasta',
                'education' => 'S1',
                'notes' => 'Anggota aktif',
                'is_active' => true,
            ],
            [
                'nik' => '2345678901234567',
                'name' => 'Siti Nurhaliza',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1985-08-22',
                'gender' => 'female',
                'address' => 'Jl. Sudirman No. 456',
                'rt' => '02',
                'rw' => '03',
                'village' => 'Cikini',
                'subdistrict' => 'Menteng',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'postal_code' => '10310',
                'phone' => '081234567891',
                'email' => 'siti.nurhaliza@email.com',
                'religion' => 'islam',
                'marital_status' => 'single',
                'occupation' => 'Guru',
                'education' => 'S2',
                'notes' => 'Guru SD',
                'is_active' => true,
            ],
            [
                'nik' => '3456789012345678',
                'name' => 'Budi Santoso',
                'place_of_birth' => 'Surabaya',
                'date_of_birth' => '1992-12-10',
                'gender' => 'male',
                'address' => 'Jl. Thamrin No. 789',
                'rt' => '03',
                'rw' => '01',
                'village' => 'Gambir',
                'subdistrict' => 'Gambir',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'postal_code' => '10110',
                'phone' => '081234567892',
                'email' => 'budi.santoso@email.com',
                'religion' => 'kristen',
                'marital_status' => 'married',
                'occupation' => 'Karyawan Swasta',
                'education' => 'D3',
                'notes' => 'Karyawan bank',
                'is_active' => true,
            ],
            [
                'nik' => '4567890123456789',
                'name' => 'Dewi Kartika',
                'place_of_birth' => 'Yogyakarta',
                'date_of_birth' => '1988-03-18',
                'gender' => 'female',
                'address' => 'Jl. Gatot Subroto No. 321',
                'rt' => '04',
                'rw' => '02',
                'village' => 'Kuningan',
                'subdistrict' => 'Kuningan',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12950',
                'phone' => '081234567893',
                'email' => 'dewi.kartika@email.com',
                'religion' => 'islam',
                'marital_status' => 'divorced',
                'occupation' => 'Perawat',
                'education' => 'D3',
                'notes' => 'Perawat rumah sakit',
                'is_active' => true,
            ],
            [
                'nik' => '5678901234567890',
                'name' => 'Eko Prasetyo',
                'place_of_birth' => 'Medan',
                'date_of_birth' => '1995-07-25',
                'gender' => 'male',
                'address' => 'Jl. Senayan No. 654',
                'rt' => '05',
                'rw' => '04',
                'village' => 'Senayan',
                'subdistrict' => 'Kebayoran Baru',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12190',
                'phone' => '081234567894',
                'email' => 'eko.prasetyo@email.com',
                'religion' => 'islam',
                'marital_status' => 'single',
                'occupation' => 'Mahasiswa',
                'education' => 'S1',
                'notes' => 'Mahasiswa semester 6',
                'is_active' => true,
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}