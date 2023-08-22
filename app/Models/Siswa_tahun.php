<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa_tahun extends Model
{
    use HasFactory;

    protected $table = 'siswa_tahun';

    protected $primaryKey = 'id_siswa_tahun';

    protected $fillable = [
        'nisn',
        'id_tingkat',
        'id_kelas',
        'id_tahun_ajaran',
    ];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'nisn');
    }
    public function tingkat() {
        return $this->belongsTo(Tingkat::class, 'id_tingkat');
    }
    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function tahun_ajaran() {
        return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran');
    }
}
