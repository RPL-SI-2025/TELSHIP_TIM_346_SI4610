<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'lamaran';

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan'); 
    }
}
