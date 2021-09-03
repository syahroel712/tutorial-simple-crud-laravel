<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "tb_user";
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_nama', 
        'user_email', 
        'user_password', 
        'user_notelp', 
        'user_alamat', 
        'user_level', 
    ];
}