<?php
 
 namespace App\Models;
  
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
  
  
 class Mahasiswa extends Model
 {
     use HasFactory;
     protected $table = 'mahasiswa';
     protected $primaryKey = 'id_mahasiswa';
     protected $fillable = [
         'foto_profile',
         'nim',
         'nama_lengkap',
         'email',
         'password',
         'jurusan',
         'no_hp',
         'user_id',
     ];
  
     public function user()
     {
         return $this->belongsTo(User::class);
     }
  
     public function dokumen()
     {
         return $this->hasOne(Dokumen::class, 'id_mahasiswa', 'id_mahasiswa');
     }
  
     public function laporans()
     {
         return $this->hasMany(Laporan::class, 'id_mahasiswa', 'id_mahasiswa');
     }
  
     public function lamaran()
     {
         return $this->hasMany(Lamaran::class, 'id_mahasiswa', 'id_mahasiswa');
     }
 }