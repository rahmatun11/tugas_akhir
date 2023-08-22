<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanah_bangunan extends Model
{
    use HasFactory;

    protected $table = 'tanah_bangunan';

    protected $primaryKey = 'id_tanah_bangunan';

    protected $fillable = [
        'nisn',
        'tanggal_bayar',
        'id_kelas',
        'id_tahun_ajaran',
        'jumlah_bayar',
    ];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'nisn');
    }
    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function tahun_ajaran() {
        return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran');
    }
}
