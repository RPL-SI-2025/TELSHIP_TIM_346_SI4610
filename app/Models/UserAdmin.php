<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $table = 'user_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'user_id',
        'email',
        'password',
        'nama_lengkap',
    ];
}
