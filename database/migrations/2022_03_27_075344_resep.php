<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Resep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('makanan_id')->constrained('makanans')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('bahan_id')->constrained('bahanbakus')->onUpdate('cascade') ->onDelete('cascade');
            $table->float('qty');
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
        Schema::dropIfExists('reseps');
    }
}
