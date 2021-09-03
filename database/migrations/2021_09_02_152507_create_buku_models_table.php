<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->id('buku_id');
            $table->string('buku_isbn')->nullable();
            $table->string('buku_judul')->nullable();
            $table->integer('buku_hal')->nullable(0);
            $table->string('buku_foto')->nullable();
            $table->text('buku_deskripsi')->nullable();
            $table->enum('buku_status', ['Tersedia', 'Kosong']);
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
        Schema::dropIfExists('tb_buku');
    }
}
