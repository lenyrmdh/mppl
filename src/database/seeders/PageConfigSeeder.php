<?php

namespace Database\Seeders;

use App\Models\PageConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(PageConfig::count()==0) {
            PageConfig::create([
                'title' => 'Selamat datang di pusat informasi karyawan DigitalEdu',
                'detail' => 'Data Employee Pt.DigitalEdu',
                'image' => '',
            ]);
        }
    }
}
