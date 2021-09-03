<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    protected $table = "tb_siswa";
    protected $primaryKey = 'siswa_id';
    protected $fillable = [
        'siswa_nis', 
        'siswa_nama', 
        'siswa_tgl_lahir', 
        'siswa_jekel', 
        'siswa_notelp', 
        'siswa_alamat', 
    ];
}