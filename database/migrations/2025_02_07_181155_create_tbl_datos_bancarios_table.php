<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDatosBancariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_datos_bancarios', function (Blueprint $table) {
            $table->bigIncrements('id_datos_bancarios');
            $table->integer('id_torneo')->nullable();
            $table->text('nombre')->nullable();
            $table->string('banco')->nullable();
            $table->bigInteger('cuenta_bancaria')->nullable();
            $table->bigInteger('clabe_bancaria')->nullable();
            $table->bigInteger('numero_tarjeta')->nullable();
            $table->string('tipo_tarjeta')->nullable();
            $table->string('archivo')->nullable();
            $table->integer('estatus')->nullable();
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
        Schema::dropIfExists('tbl_datos_bancarios');
    }
}
