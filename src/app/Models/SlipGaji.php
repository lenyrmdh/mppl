<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SlipGaji extends Model
{
    use HasFactory;
    protected $table = 'slip_gajis';
    protected $fillable = ([
        'pegawai_id',
        'total_lembur',
        'total_cuti',
        'sisa_cuti',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'gaji_bersih',
        'periode',
    ]);
    
    // app/Models/SlipGaji.php
    public function dataPegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'pegawai_id');
    }

    public function pegawai()
{
    return $this->belongsTo(DataPegawai::class, 'pegawai_id');
}

}
 