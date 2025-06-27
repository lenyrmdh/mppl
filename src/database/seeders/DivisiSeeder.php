<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiSeeder extends Seeder
{
    public function run(): void
    {
        Divisi::insert([
            ['nama' => 'Direktur Utama'],
            ['nama' => 'Pemasaran'],
            ['nama' => 'SDM'],
            ['nama' => 'Operasional'],
            ['nama' => 'Teknologi Informasi'],
            ['nama' => 'Legal'],
            ['nama' => 'Produksi'],
            ['nama' => 'Riset & Pengembangan'],
            ['nama' => 'Layanan Pelanggan'],
            ['nama' => 'Umum'],
        ]);
    }
}
