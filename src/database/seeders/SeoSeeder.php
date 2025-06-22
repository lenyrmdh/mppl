<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Seo::count()==0) {
            Seo::create([
                'title' => 'Leadership Team',
                'description' => 'Kenali Leny (Web Developer), Adam (Network Engineer) dan Anel (Data Analyst Specialist), — tiga talenta IT berbakat dari Tangerang yang siap membangun solusi digital terbaik.',
                'keywords' => 'Pt.DigitalEdu',
                'cannonical_url'=> 'http://localhost',
                'robots'=> 'index, follow',
                'og_image'=> '',
            ]);
        }
    }
}
