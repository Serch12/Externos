<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sedes', function (Blueprint $table) {
            $table->bigIncrements('id_sede');
            $table->string('nombre')->nullable();
            $table->text('ubicacion')->nullable();
            $table->text('lugar_entrenamiento')->nullable();
            $table->text('contactos')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->integer('estatus_sede')->nullable();
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
        Schema::dropIfExists('tbl_sedes');
    }
}
