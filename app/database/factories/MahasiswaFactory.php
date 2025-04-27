<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory; // Menambahkan trait HasFactory

    protected $fillable = [
        'nama_lengkap',
        'NIM',
        'email',
        'password',
        'jurusan',
    ];
}