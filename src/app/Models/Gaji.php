<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id', 'periode', 'gaji_pokok', 'tunjangan', 'potongan', 'total_gaji',
    ];

    public function data_pegawai()
    {
        return $this->belongsTo(DataPegawai::class);
    }
}
