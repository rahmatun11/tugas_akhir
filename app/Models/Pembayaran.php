<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'nisn',
        'tanggal_bayar',
        'bulan_bayar',
        'id_kelas',
        'id_tahun_ajaran',
        'id_spp',
        'jumlah_bayar',
        'status',
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
    public function spp() {
        return $this->belongsTo(Spp::class, 'id_spp');
    }
}
