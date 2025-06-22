<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gaji;
use App\Models\DataPegawai;
use Carbon\Carbon;

class GajiSeeder extends Seeder
{
    public function run(): void
    {
        $pegawaiList = DataPegawai::all();

        foreach ($pegawaiList as $pegawai) {
            // Hapus data gaji Jan-Jun 2025 sebelumnya agar tidak double
            Gaji::where('pegawai_id', $pegawai->id)
                ->whereBetween('periode', [
                    Carbon::create(2025, 1, 1),
                    Carbon::create(2025, 6, 30)
                ])
                ->delete();

            // ✅ Gaji besar untuk pegawai 1-3
            if (in_array($pegawai->id, [1, 2, 3])) {
                $gajiPokok = rand(9000000, 10000000);
                $tunjangan = rand(2000000, 3000000);
                $potongan = rand(100000, 200000);
            } else {
                $gajiPokok = rand(6500000, 8000000);
                $tunjangan = rand(1000000, 1800000);
                $potongan = rand(200000, 500000);
            }

            $totalGaji = round($gajiPokok + $tunjangan - $potongan);

            for ($bulan = 1; $bulan <= 6; $bulan++) {
                $periode = Carbon::createFromDate(2025, $bulan, 1);

                Gaji::create([
                    'pegawai_id' => $pegawai->id,
                    'periode' => $periode,
                    'gaji_pokok' => $gajiPokok,
                    'tunjangan' => $tunjangan,
                    'potongan' => $potongan,
                    'total_gaji' => $totalGaji,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
