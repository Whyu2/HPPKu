<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eveent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eveents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waktu_id')->constrained('waktus')->onUpdate('cascade') ->onDelete('cascade');
            $table->char('kd_event', 11);
            $table->char('nama_event', 128);
            $table->integer('total_bahan')->nullable();
            $table->integer('total_btkl')->nullable();
            $table->integer('total_bop')->nullable();
            $table->integer('porsi')->nullable();
            $table->integer('total_produksi')->nullable();
            $table->integer('total_produksi_p')->nullable();
            $table->integer('h_jual_p')->nullable();
            $table->integer('revenue')->nullable();
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
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
        Schema::dropIfExists('eveents');
    }
}
