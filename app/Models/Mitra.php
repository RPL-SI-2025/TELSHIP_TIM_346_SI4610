<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';
    protected $primaryKey = 'id_perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'logo_perusahaan',
        'deskripsi_perusahaan',
    ];


    public function userMentors()
    {
        return $this->hasMany(UserMentor::class, 'id_perusahaan', 'id_perusahaan');
    }
}