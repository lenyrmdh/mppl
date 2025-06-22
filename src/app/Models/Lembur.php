<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lembur extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'keterangan',
    ];

    public function data_pegawai()
    {
        return $this->belongsTo(DataPegawai::class);
    }
}
