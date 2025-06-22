<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id', 'tanggal', 'jam_masuk', 'jam_keluar', 'status',
    ];

    public function data_pegawai()
    {
        return $this->belongsTo(DataPegawai::class);
    }
}
