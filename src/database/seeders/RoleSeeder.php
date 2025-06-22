<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles
        $admin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $pegawai = Role::firstOrCreate(['name' => 'pegawai', 'guard_name' => 'web']);

        // Daftar model yang akan dibuatkan permission-nya
        $models = [
            'pegawai',
            'jabatan',
            'divisi',
            'absensi',
            'cuti',
            'lembur',
            'gaji',
            'slip_gaji', // ✅ Tambahkan slip_gaji di sini
        ];

        // Aksi umum
        $actions = ['view', 'view_any', 'create', 'update', 'delete', 'delete_any'];

        // Buat permission untuk semua model + aksi
        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$action}_{$model}",
                    'guard_name' => 'web',
                ]);
            }
        }

        // Berikan semua permission ke admin
        $admin->givePermissionTo(Permission::all());

        // Pegawai hanya bisa lihat dan update data dirinya sendiri
        $pegawaiPermissions = [
            'view_pegawai', 'update_pegawai',

            'view_absensi', 'view_any_absensi',

            'view_gaji', 'view_any_gaji',

            'view_cuti', 'view_any_cuti',

            'view_lembur', 'create_lembur', 'view_any_lembur',

            // ✅ Tambahkan akses slip gaji
            'view_slip_gaji', 'view_any_slip_gaji',
        ];

        foreach ($pegawaiPermissions as $permName) {
            $perm = Permission::where('name', $permName)->first();
            if ($perm) {
                $pegawai->givePermissionTo($perm);
            }
        }
    }
}
