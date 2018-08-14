<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrevisaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('placeId')->unsigned();
            $table->string('periodo');
            $table->integer('maximaGrau');
            $table->integer('minimaGrau');
            $table->string('descricao');
            $table->string('estabilidadeTempo');
            $table->string('direcaoVento');
            $table->string('intensidadeVento');
            $table->integer('umidArMax');
            $table->integer('umidArMin');            
            $table->timestamps();

            $table->foreign('placeId')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('previsoes');
    }
}
