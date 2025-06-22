<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use App\Models\DataPegawai;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $pegawaiList = DataPegawai::all();
        $startDate = Carbon::now()->subMonths(6);
        $endDate = Carbon::now();

        foreach ($pegawaiList as $pegawai) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {
                if (!$date->isWeekend()) {
                    // 90% kemungkinan akan absen di hari tersebut
                    if (rand(1, 100) <= 90) {
                        Absensi::create([
                            'pegawai_id' => $pegawai->id,
                            'tanggal' => $date->toDateString(),
                            'status' => $this->randomStatus(),
                        ]);
                    }
                }

                $date->addDay();
            }
        }
    }

    private function randomStatus()
    {
        $rand = rand(1, 100);
        if ($rand <= 85) return 'hadir';
        if ($rand <= 95) return 'izin';
        return 'sakit';
    }
}
