<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    public function mentor() {
        return $this->belongsTo(User::class, 'mentor_id');
    }
    
    public function pelamars() {
        return $this->hasMany(Pelamar::class);
    }
}
