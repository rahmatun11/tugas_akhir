<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapitulasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapitulasi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nisn');
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_dat');
            $table->foreign('id_dat')->references('id_dat')->on('dat')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_kasur_lemari');
            $table->foreign('id_kasur_lemari')->references('id_kasur_lemari')->on('kasur_lemari')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_kegiatan_pertahun');
            $table->foreign('id_kegiatan_pertahun')->references('id_kegiatan_pertahun')->on('kegiatan_pertahun')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_tanah_bangunan');
            $table->foreign('id_tanah_bangunan')->references('id_tanah_bangunan')->on('tanah_bangunan ')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('jumlah_bayar');
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
        Schema::dropIfExists('rekapitulasi');
    }
}
