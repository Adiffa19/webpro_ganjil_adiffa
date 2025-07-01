<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenBermasalah extends Model
{
    use HasFactory;
    protected $table = 'absen_bermasalah';
    protected $fillable = [
        'kode_keterangan',
        'keterangan',
        'lokasi',
        'tanggal_awal',
        'tanggal_akhir',
        'shift',
        'kondisi',
        'petugas_input',
    ];
}