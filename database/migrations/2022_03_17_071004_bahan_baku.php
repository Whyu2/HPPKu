<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BahanBaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahanbakus', function (Blueprint $table) {
            $table->id();
            $table->char('kd_bahan', 11);
            $table->char('nama_bahan', 128);
            $table->char('satuan', 11);
            $table->integer('harga');
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
        Schema::dropIfExists('bahanbakus');
    }
}
