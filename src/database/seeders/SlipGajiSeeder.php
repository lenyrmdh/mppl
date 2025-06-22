<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SlipGaji;
use App\Models\Gaji;
use App\Models\Cuti;
use App\Models\Lembur;
use Carbon\Carbon;

class SlipGajiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua gaji bulan Juni 2025
        $gajiList = Gaji::whereMonth('periode', 6)
                        ->whereYear('periode', 2025)
                        ->get();

        foreach ($gajiList as $gaji) {
            $pegawaiId = $gaji->pegawai_id;

            // Hitung total cuti bulan Juni
            $totalCuti = Cuti::where('pegawai_id', $pegawaiId)
                ->whereMonth('tanggal_mulai', 6)
                ->whereYear('tanggal_mulai', 2025)
                ->count();

            // Hitung total cuti tahun 2025
            $totalCutiTahunIni = Cuti::where('pegawai_id', $pegawaiId)
                ->whereYear('tanggal_mulai', 2025)
                ->count();

            // Hitung total lembur bulan Juni (jam valid dan tidak minus)
            $totalLembur = 0;
            $lemburRecords = Lembur::where('pegawai_id', $pegawaiId)
                ->whereMonth('tanggal', 6)
                ->whereYear('tanggal', 2025)
                ->get();

            foreach ($lemburRecords as $lembur) {
                $jamMulai = Carbon::parse($lembur->jam_mulai);
                $jamSelesai = Carbon::parse($lembur->jam_selesai);

                // Hitung durasi lembur secara absolut agar tidak minus
                if ($jamMulai && $jamSelesai) {
                    $durasi = abs($jamSelesai->diffInMinutes($jamMulai)) / 60;
                    $totalLembur += $durasi;
                }
            }

            $totalLembur = round($totalLembur); // Bulatkan ke jam terdekat
            $sisaCuti = max(0, 12 - $totalCutiTahunIni); // Jatah cuti tahunan: 12 hari

            // Simpan atau update slip gaji
            SlipGaji::updateOrCreate(
                [
                    'pegawai_id' => $pegawaiId,
                    'periode' => 'Juni 2025',
                ],
                [
                    'total_lembur' => $totalLembur,
                    'total_cuti' => $totalCuti,
                    'sisa_cuti' => $sisaCuti,
                    'gaji_pokok' => $gaji->gaji_pokok,
                    'tunjangan' => $gaji->tunjangan,
                    'potongan' => $gaji->potongan,
                    'gaji_bersih' => $gaji->total_gaji,
                ]
            );
        }
    }
}
