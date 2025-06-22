<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataPegawai;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
    ];

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'pegawai_id');
    }
}
