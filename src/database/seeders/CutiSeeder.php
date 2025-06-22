<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuti;
use App\Models\DataPegawai;
use Carbon\Carbon;

class CutiSeeder extends Seeder
{
    public function run(): void
    {
        $pegawaiList = DataPegawai::all();

        foreach ($pegawaiList as $pegawai) {
            // Setiap pegawai punya kemungkinan cuti 1–2 kali dalam 6 bulan
            $jumlahCuti = rand(0, 2);

            for ($i = 0; $i < $jumlahCuti; $i++) {
                $tanggalMulai = Carbon::now()->subMonths(rand(0, 5))->subDays(rand(1, 25));
                $lamaCuti = rand(1, 3); // 1–3 hari
                $tanggalSelesai = $tanggalMulai->copy()->addDays($lamaCuti - 1);

                Cuti::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal_mulai' => $tanggalMulai->toDateString(),
                    'tanggal_selesai' => $tanggalSelesai->toDateString(),
                    'alasan' => $this->getRandomAlasan(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getRandomAlasan()
    {
        $alasan = [
            'Cuti pribadi',
            'Urusan keluarga',
            'Liburan singkat',
            'Cuti sakit ringan',
            'Pernikahan saudara',
            'Kebutuhan mendesak'
        ];

        return $alasan[array_rand($alasan)];
    }
}
