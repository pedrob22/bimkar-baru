<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = [
            [
                'nama' => 'Dr. Budi Santoso, Sp.PD',
                'email' => 'budi.santoso@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Pahlawan No. 123, Jakarta Selatan',
                'no_ktp' => '3175062505800001',
                'no_hp' => '081234567890',
                'poli' => 'Penyakit Dalam',
            ],
            [
                'nama' => 'Dr. Siti Rahayu, Sp.A',
                'email' => 'siti.rahayu@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Anggrek No. 45, Jakarta Pusat',
                'no_ktp' => '3175064610790002',
                'no_hp' => '081234567891',
                'poli' => 'Anak',
            ],
            [
                'nama' => 'Dr. Ahmad Wijaya, Sp.OG',
                'email' => 'ahmad.wijaya@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Melati No. 78, Jakarta Barat',
                'no_ktp' => '3175061505780003',
                'no_hp' => '081234567892',
                'poli' => 'Kebidanan dan Kandungan',
            ],
            [
                'nama' => 'Dr. Rina Putri, Sp.M',
                'email' => 'rina.putri@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Dahlia No. 32, Jakarta Timur',
                'no_ktp' => '3175062708850004',
                'no_hp' => '081234567893',
                'poli' => 'Mata',
            ],
            [
                'nama' => 'Dr. Doni Pratama, Sp.THT',
                'email' => 'doni.pratama@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Kenanga No. 56, Jakarta Utara',
                'no_ktp' => '3175061002820005',
                'no_hp' => '081234567894',
                'poli' => 'THT',
            ],
        ];
        $pasiens = [
            [
                'nama' => 'Andi Saputra',
                'email' => 'andi.pasien@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'no_ktp' => '3175062501990006',
                'no_hp' => '081234567895',
            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti.pasien@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Kemerdekaan No. 77, Jakarta',
                'no_ktp' => '3175060412800007',
                'no_hp' => '081234567896',
            ],
        ];
        // foreach ($dokters as $dokter) {
        //     User::create($dokter);
        // }
        // foreach ($pasiens as $pasien) {
        //     User::create($pasien);
        // }
        foreach ($dokters as $dokter) {
            User::firstOrCreate(
                ['email' => $dokter['email']], // cek berdasarkan email
                $dokter // kalau belum ada, buat
            );
        }

        foreach ($pasiens as $pasien) {
            User::firstOrCreate(
                ['email' => $pasien['email']],
                $pasien
            );
        }
    }
}
