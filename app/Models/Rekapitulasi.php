<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    protected $table = "rekapitulasi";
    protected $guarded = [''];
    use HasFactory;

    public function Buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function Dat()
    {
        return $this->belongsTo(Dat::class, 'id_dat');
    }
    public function Kasur_lemari()
    {
        return $this->belongsTo(Kasur_lemari::class, 'id_kasur_lemari');
    }
    public function Kegiatan_pertahun()
    {
        return $this->belongsTo(Kegiatan_pertahun::class, 'id_kegiatan_pertahun');
    }
    public function Tanah_bangunan()
    {
        return $this->belongsTo(Tanah_bangunan::class, 'id_tanah_bangunan');
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class,'nisn');
    }
}
