<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jugadores', function (Blueprint $table) {
            $table->bigIncrements('id_jugador');
            $table->integer('creacion')->nullable()->default(0);
            $table->string('folio')->nullable();
            $table->text('foto')->nullable();
            $table->string('nombre')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('categoria')->nullable();
            $table->string('sede')->nullable();
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
        Schema::dropIfExists('tbl_jugadores');
    }
}
