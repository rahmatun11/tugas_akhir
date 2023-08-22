<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTahunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_tahun', function (Blueprint $table) {
                $table->id('id_siswa_tahun');
               
                $table->char('nisn', 15);
                $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
                

                $table->unsignedBigInteger('id_tingkat');
                $table->foreign('id_tingkat')->references('id_tingkat')->on('tingkat')->onDelete('cascade')->onUpdate('cascade');

                $table->unsignedBigInteger('id_kelas');
                $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
    
                $table->unsignedBigInteger('id_tahun_ajaran');
                $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');

                
                
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
        Schema::dropIfExists('siswa_tahun');
    }
}
