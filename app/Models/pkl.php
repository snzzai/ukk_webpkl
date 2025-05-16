<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Guru;


class Pkl extends Model
{
    protected $table = 'pkl';
    protected $fillable = ['siswa_id', 'industri_id', 'guru_id', 'mulai', 'selesai'];
    // di App\Models\Pkl.php
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }


    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }


    protected static function booted()
    {
        //
    }


}
