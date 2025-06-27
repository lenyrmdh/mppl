<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        Jabatan::insert([
            ['nama' => 'Direktur Utama'],
            ['nama' => 'Supervisor'],
            ['nama' => 'Staff IT'],
            ['nama' => 'Staff Keuangan'],
            ['nama' => 'Admin HRD'],
            ['nama' => 'Admin Operasional'],
            ['nama' => 'Marketing Officer'],
            ['nama' => 'Analis Data'],
            ['nama' => 'Customer Service'],
            ['nama' => 'Desainer Grafis'],
            ['nama' => 'Quality Control'],
            ['nama' => 'Security'],
            ['nama' => 'Office Boy'],
            ['nama' => 'Legal Officer'],
            ['nama' => 'Training Coordinator'],
        ]);
    }
}
