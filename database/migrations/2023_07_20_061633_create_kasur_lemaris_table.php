<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasurLemarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasur_lemari', function (Blueprint $table) {
            $table->id('id_kasur_lemari');
                
                $table->char('nisn', 15);
                $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
                
                $table->date('tanggal_bayar');
                
                $table->unsignedBigInteger('id_kelas');
                $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
    
                $table->unsignedBigInteger('id_tahun_ajaran');
                $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
                
                $table->integer('jumlah_bayar');
    
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
        Schema::dropIfExists('kasur_lemari');
    }
}
