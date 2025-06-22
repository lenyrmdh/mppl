<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_divisi'];

    public function data_pegawais()
    {
        return $this->hasMany(DataPegawai::class);
    }
}
