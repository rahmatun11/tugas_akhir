<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTabungansTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_tabungan', function (Blueprint $table) {
            $table->id('id_laporan_tabungan');
            
            $table->date('tanggal_laporan');

            $table->string('bulan_laporan', 50);

            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');

            $table->string('keterangan', 250);

            $table->string('dokumen', 250);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_tabungan');
    }
}
