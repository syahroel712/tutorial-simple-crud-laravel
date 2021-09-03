<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id('siswa_id');
            $table->string('siswa_nis')->nullable();
            $table->string('siswa_nama')->nullable();
            $table->date('siswa_tgl_lahir')->nullable();
            $table->enum('siswa_jekel', ['Laki laki', 'Perempuan']);
            $table->string('siswa_notelp')->nullable();
            $table->text('siswa_alamat')->nullable();
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
        Schema::dropIfExists('tb_siswa');
    }
}
