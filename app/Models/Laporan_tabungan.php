<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_tabungan extends Model
{
    use HasFactory;

    protected $table = 'laporan_tabungan';

    protected $primaryKey = 'id_laporan_tabungan';

    protected $fillable = [
        'tanggal_laporan',
        'bulan_laporan',
        'id_tahun_ajaran',
        'keterangan',
        'dokumen',
    ];

    public function tahun_ajaran() {
        return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran');
    }
}
