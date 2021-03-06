<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('makanan_id')->constrained('makanans')->onUpdate('cascade') ->onDelete('cascade');
            $table->integer('besaran_btkl');
            $table->integer('besaran_bop');
            $table->integer('besaran_cost');
            $table->integer('total_bahan');
            $table->integer('total_btkl');
            $table->integer('total_bop');
            $table->integer('total_hpp');
            $table->integer('h_jual');
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
        Schema::dropIfExists('hpps');
    }
}
