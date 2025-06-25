<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil dulu RoleSeeder agar role sudah ada di DB
        $this->call([
            RoleSeeder::class,
        ]);

        // Buat user admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'), // jangan lupa password
        ]);
        $admin->assignRole('super_admin'); // assign role admin

        // Buat user dokter
        $dokter = User::factory()->create([
            'name' => 'Pegawai',
            'email' => 'pegawai@pegawai.com',
            'password' => bcrypt('pegawai123'),
        ]);
        $dokter->assignRole('pegawai'); // assign role dokter

        // Seeder lain dipanggil setelah user dan role sudah siap
        $this->call([
            JabatanSeeder::class,
            DivisiSeeder::class,
            DataPegawaiSeeder::class,
            RoleSeeder::class,        // Jika kamu juga pakai spatie/permission
            AbsensiSeeder::class,
            CutiSeeder::class,
            LemburSeeder::class,
            GajiSeeder::class,
            SlipGajiSeeder::class,
        ]);
    }
}
           