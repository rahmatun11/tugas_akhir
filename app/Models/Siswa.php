<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'nisn';

    // protected $fillable = [
    //     'nisn',
    //     'nis',
    //     'nama',
    //     'level',
    //     'password',
    //     'id_tahun_ajaran',
    //     'no_telp',
    //     'alamat',
    //     'id_spp',
    // ];


    protected $guarded = [''];

    public function tahun_ajaran() {
        return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran');
    }
    public function spp() {
        return $this->belongsTo(Spp::class, 'id_spp');
    }
}
