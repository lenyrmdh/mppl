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
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2005-12-06',
            'alamat' => 'Jl. Graha No. 3 Tangerang',
            'no_hp' => '081234567890',
            'jabatan_id' => 1,
            'divisi_id' => 1,
        ]);

        // Admin 3
        $admin3 = DataPegawai::create([
            'nip' => '19870003',
            'nama' => 'Anel Safitri',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '2005-06-07',
            'alamat' => 'Jl. Citra No. 4 Tangerang',
            'no_hp' => '081234567890',
            'jabatan_id' => 1,
            'divisi_id' => 1,
        ]);

        // Pegawai 4–50 dengan data cuti, lembur, gaji
        foreach (range(4, 50) as $i) {
            $pegawai = DataPegawai::create([
                'nip' => '198700' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => $faker->name,
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'alamat' => $faker->address,
                'no_hp' => '08' . $faker->numerify('##########'),
                'jabatan_id' => rand(2, 14),
                'divisi_id' => rand(2, 10),
            ]);

            
            Cuti::create([
                'pegawai_id' => $pegawai->id,
                'tanggal_mulai' => now()->subDays(rand(10, 30)),
                'tanggal_selesai' => now()->subDays(rand(1, 9)),
                'alasan' => $faker->randomElement([
                    'Kucing saya melahirkan',
                    'Cuti pribadi untuk istirahat',
                    'Mengurus keperluan keluarga',
                    'Liburan singkat untuk refreshing',
                    'Istirahat karena sakit ringan',
                    'Menghadiri pernikahan saudara',
                    'Ada keperluan mendesak di luar kota',
                    'Mengurus dokumen penting',
                    'Mengantar anggota keluarga ke rumah sakit',
                    'Pemulihan dari kelelahan kerja',
                    'Izin menghadiri acara keluarga',
                ]),
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
