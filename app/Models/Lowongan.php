<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';
    protected $primaryKey = 'id_lowongan';

    protected $fillable = [
        'nama_posisi',
        'deskripsi_pekerjaan',
        'jumlah_kuota',
        'durasi_magang',
        'persyaratan',
        'id_mentor',
        'status',
    ];

    public function userMentor()
    {
        return $this->belongsTo(UserMentor::class, 'id_mentor', 'id_mentor');
    }
    
}