<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            // $table->id();
            $table->char('nisn', 15)->primary();

            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_spp');
            $table->foreign('id_spp')->references('id')->on('spp')->onDelete('cascade')->onUpdate('cascade');            
            $table->foreignId('id_siswa')->constrained('users')->onDelete('cascade');
            // $table->foreignId('id_spp')->constrained('spp')->onDelete('cascade');
            // $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');

            // $table->string('nisn');
            // $table->string('nis');
            // $table->string('nama');
            // $table->longText('alamat');
            // $table->bigInteger('no_telp');
            
            
            
            $table->char('nis', 10);
            $table->string('nama', 50);
            $table->text('alamat');
            $table->string('no_telp', 15);


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
        Schema::dropIfExists('siswa');
    }
}
