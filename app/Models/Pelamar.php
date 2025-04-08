<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    public function lowongan() {
        return $this->belongsTo(Lowongan::class);
    }
    
    public function mahasiswa() {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
