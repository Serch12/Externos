<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDocumentosJugadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_documentos_jugador', function (Blueprint $table) {
            $table->bigIncrements('id_docu_jugador');
            $table->integer('id_jugador')->nullable();
            $table->text('tipo')->nullable();
            $table->text('archivo')->nullable();
            $table->integer('estatus')->nullable()->default(0);
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
        Schema::dropIfExists('tbl_documentos_jugador');
    }
}
