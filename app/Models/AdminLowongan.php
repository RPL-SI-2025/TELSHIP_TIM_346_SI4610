<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLowongan extends Model
{
    protected $table = 'admin_lowongan';

    protected $fillable = ['title', 'company', 'status'];
}
