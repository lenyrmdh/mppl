<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jabatan'];

    public function data_pegawais()
    {
        return $this->hasMany(DataPegawai::class);
    }
}

