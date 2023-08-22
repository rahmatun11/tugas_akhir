<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    protected $table = "rekap";
    protected $guarded = [''];
    use HasFactory;

    public function Setor_tabungan()
    {
        return $this->belongsTo(Setor_tabungan::class, 'id_setor_tabungan');
    }

    public function Tarik_tabungan()
    {
        return $this->belongsTo(Tarik_tabungan::class, 'id_tarik_tabungan');
    }
    public function siswa() {
        return $this->belongsTo(Siswa::class, 'nisn');
    }
    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
