<?php


namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'status_pkl'];
    // Model Siswa.php buat ambil siswa yang udah kirim data biar true
    public function pkl()
    {
        return $this->hasOne(pkl::class, 'siswa_id', 'id');  // Sesuaikan dengan nama kolom yang ada
    }
    // Accessor status_pkl
    public function getStatusPklAttribute()
    {
        return $this->pkl()->exists();
    }


}
