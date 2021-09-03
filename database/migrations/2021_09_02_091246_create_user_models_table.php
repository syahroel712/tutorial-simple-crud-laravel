<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_nama')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_password')->nullable();
            $table->string('user_notelp')->nullable();
            $table->text('user_alamat')->nullable();
            $table->enum('user_level', ['owner', 'kasir'])->nullable();
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
        Schema::dropIfExists('tb_user');
    }
}
