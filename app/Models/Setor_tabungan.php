<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor_tabungan extends Model
{
    use HasFactory;

    protected $table = 'setor_tabungan';

    protected $primaryKey = 'id_setor_tabungan';

    protected $fillable = [
        'nisn',
        'id_tingkat',
        'id_kelas',
        'tanggal',
        'setor',
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
}
