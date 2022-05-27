<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EveentMakanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eveent_makanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eveent_id')->constrained('eveents')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('hpp_id')->constrained('hpps')->onUpdate('cascade') ->onDelete('cascade');
            $table->integer('qty');
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
        Schema::dropIfExists('eveent_makanans');
    }
}
