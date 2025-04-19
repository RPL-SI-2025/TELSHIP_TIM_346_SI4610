<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function mahasiswa()
    {
        return $this->hasOne(\App\Models\Mahasiswa::class, 'user_id', 'id');
    }

    public function lowongans()
    {
        return $this->hasMany(Lowongan::class, 'mentor_id');
    }

    public function pelamars()
    {
        return $this->hasMany(Pelamar::class, 'mahasiswa_id');
    }
}
