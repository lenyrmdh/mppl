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
            // Ambil semua data pegawai
            $pegawaiList = DataPegawai::all();

            foreach ($pegawaiList as $pegawai) {
                // Setiap pegawai punya kemungkinan cuti 1–2 kali dalam 6 bulan
                $jumlahCuti = rand(0, 2);

                for ($i = 0; $i < $jumlahCuti; $i++) {
                    // Acak tanggal cuti dalam 6 bulan terakhir
                    $tanggalMulai = Carbon::now()->subMonths(rand(0, 5))->subDays(rand(1, 25));
                    $lamaCuti = rand(1, 3); // Durasi cuti 1–3 hari
                    $tanggalSelesai = $tanggalMulai->copy()->addDays($lamaCuti - 1);

                    // Buat data cuti
                    Cuti::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal_mulai' => $tanggalMulai->toDateString(),
                        'tanggal_selesai' => $tanggalSelesai->toDateString(),
                        'alasan' => $this->getRandomAlasan(),
                        'status' => 'Disetujui', // Bisa diganti dengan status lain kalau perlu
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Alasan cuti yang masuk akal dan relevan
        private function getRandomAlasan()
        {
            $alasan = [
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
                'Kucing saya melahirkan',
            ];

            return $alasan[array_rand($alasan)];
        }
    }
