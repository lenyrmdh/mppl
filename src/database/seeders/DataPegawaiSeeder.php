<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPegawai;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Gaji;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DataPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Admin 1
        $admin1 = DataPegawai::create([
            'nip' => '19870001',
            'nama' => 'Leny Ramadhani Setiawan',
            'email' => 'Leny@example.com',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '2005-11-01',
            'alamat' => 'Jl. Raya No. 1, Tangerang',
            'no_hp' => '081234567890',
            'jabatan_id' => 1,
            'divisi_id' => 1,
        ]);

        // Admin 2
        $admin2 = DataPegawai::create([
            'nip' => '19870006',
            'nama' => 'Adam Putra Pratama',
            'email' => 'adam@example.com',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2005-12-06',
            'alamat' => 'Jl. Graha No. 3 Tangerang',
            'no_hp' => '081234567890',
            'jabatan_id' => 2,
            'divisi_id' => 5,
        ]);

        // Admin 3
        $admin3 = DataPegawai::create([
            'nip' => '19870003',
            'nama' => 'Anel Safitri',
            'email' => 'anel@example.com',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '2005-06-07',
            'alamat' => 'Jl. Citra No. 4 Tangerang',
            'no_hp' => '081234567890',
            'jabatan_id' => 3,
            'divisi_id' => 4,
        ]);

        // Pegawai 4–50 dengan data cuti, lembur, gaji
        foreach (range(4, 50) as $i) {
            $pegawai = DataPegawai::create([
                'nip' => '198700' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => $faker->name,
                'email' => "pegawai{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'alamat' => $faker->address,
                'no_hp' => '08' . $faker->numerify('##########'),
                'jabatan_id' => rand(2, 14),
                'divisi_id' => rand(1, 10),
            ]);

            // Tambah data cuti
            Cuti::create([
                'pegawai_id' => $pegawai->id,
                'tanggal_mulai' => now()->subDays(rand(10, 30)),
                'tanggal_selesai' => now()->subDays(rand(1, 9)),
                //'jumlah_hari' => rand(1, 5),
                'alasan' => $faker->sentence,
            ]);

            // Tambah data lembur
            Lembur::create([
                'pegawai_id' => $pegawai->id,
                'tanggal' => now()->subDays(rand(1, 15)),
                'jam_mulai' => '18:00',
                'jam_selesai' => '21:00',
                'keterangan' => 'Lembur project akhir bulan',
            ]);

            // Tambah data gaji
            Gaji::create([
                'pegawai_id' => $pegawai->id,
                'periode' => now()->startOfMonth(),
                'gaji_pokok' => rand(4000000, 7000000),
                'lembur' => rand(100000, 300000),
                'potongan' => rand(50000, 150000),
                'total_gaji' => 0, // akan dihitung ulang di bawah
            ]);
        }

        // Update total_gaji
        foreach (Gaji::all() as $gaji) {
            $gaji->total_gaji = $gaji->gaji_pokok + $gaji->lembur - $gaji->potongan;
            $gaji->save();
        }
    }
}
