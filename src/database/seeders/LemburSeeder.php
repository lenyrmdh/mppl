<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lembur;
use App\Models\DataPegawai;
use Carbon\Carbon;

class LemburSeeder extends Seeder
{
    public function run(): void
    {
        $pegawaiList = DataPegawai::all();

        foreach ($pegawaiList as $pegawai) {
            // Untuk setiap pegawai, buat lembur 0-3 kali per bulan selama 6 bulan terakhir
            for ($i = 0; $i < 6; $i++) {
                $jumlahLembur = rand(0, 3); // 0-3 lembur per bulan
                for ($j = 0; $j < $jumlahLembur; $j++) {
                    $tanggal = Carbon::now()->startOfMonth()->subMonths($i)->addDays(rand(0, 27));
                    $jamMulai = Carbon::createFromTime(18, 0); // mulai jam 18:00
                    $durasiJam = rand(1, 3); // durasi 1-3 jam
                    $jamSelesai = $jamMulai->copy()->addHours($durasiJam);

                    Lembur::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal' => $tanggal,
                        'jam_mulai' => $jamMulai->format('H:i'),
                        'jam_selesai' => $jamSelesai->format('H:i'),
                        'keterangan' => 'Lembur bulan ' . $tanggal->format('F Y'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
