<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'mahasiswa_id', 'lowongan_id'];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
