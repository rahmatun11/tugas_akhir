<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetorTabungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setor_tabungan', function (Blueprint $table) {
            $table->id('id_setor_tabungan');
            $table->char('nisn', 15);
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            

            $table->unsignedBigInteger('id_tingkat');
            $table->foreign('id_tingkat')->references('id_tingkat')->on('tingkat')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade')->onUpdate('cascade');

            $table->date('tanggal');
            $table->decimal('setor', 12, 2);
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
        Schema::dropIfExists('setor_tabungan');
    }
}
