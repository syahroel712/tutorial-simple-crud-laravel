<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    protected $table = "tb_buku";
    protected $primaryKey = 'buku_id';
    protected $fillable = [
        'buku_isbn', 
        'buku_judul', 
        'buku_hal', 
        'buku_foto', 
        'buku_deskripsi', 
        'buku_status', 
    ];
}
