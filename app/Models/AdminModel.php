<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_admin',
        "username",
        'password',
        'nama_lengkap',
    ];

    public $timestamps = false;
}
