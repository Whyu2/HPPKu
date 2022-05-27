<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Makanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategoris')->onUpdate('cascade') ->onDelete('cascade');
            $table->char('kd_makanan', 11);
            $table->char('nama_makanan', 128);
            $table->string('penyajian');
            $table->char('hpp', 11)->nullable();
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
        Schema::dropIfExists('makanans');
    }
}
