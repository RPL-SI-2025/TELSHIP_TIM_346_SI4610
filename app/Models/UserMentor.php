<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMentor extends Model
{
    use HasFactory;

    protected $table = 'user_mentor';
    protected $primaryKey = 'id_mentor';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'id_perusahaan',
        'user_id',
    ];

    // Relasi: User Mentor milik satu Mitra
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lowongans()
    {
        return $this->hasMany(Lowongan::class, 'id_mentor', 'id_mentor');
    }
}