<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;
    protected $table = 'pkl';

    protected $fillable = [
        'siswa_id', 
        'industri_id', 
        'guru_id', 
        'tanggal_mulai',  // Diubah dari 'mulai'
        'tanggal_selesai' // Diubah dari 'selesai'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'industri_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}