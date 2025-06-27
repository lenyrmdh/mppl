<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class DataPegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nip', 'nama', 'password', 'role',
        'jenis_kelamin', 'tanggal_lahir', 'alamat', 'no_hp',
        'jabatan_id', 'divisi_id',
    ];

    public function getNameAttribute(): string
    {
        return $this->nama ?? 'Tanpa Nama';
    }


    // Relasi
    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'pegawai_id');
    }

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'pegawai_id');
    }

    public function gajis()
    {
        return $this->hasMany(Gaji::class, 'pegawai_id');
    }

    public function lemburs()
    {
        return $this->hasMany(Lembur::class, 'pegawai_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    // Accessor: Total Gaji
    public function getTotalGajiAttribute()
    {
        return $this->gajis->sum('total_gaji');
    }

    // Accessor: Total Jam Lembur
    public function getTotalLemburAttribute()
    {
        return $this->lemburs->sum(function ($lembur) {
            if (!$lembur->jam_mulai || !$lembur->jam_selesai) return 0;

            return \Carbon\Carbon::parse($lembur->jam_mulai)
                ->diffInHours(\Carbon\Carbon::parse($lembur->jam_selesai));
        });
    }

    
}
