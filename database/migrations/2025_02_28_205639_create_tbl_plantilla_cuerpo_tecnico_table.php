<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPlantillaCuerpoTecnicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plantilla_cuerpo_tecnico', function (Blueprint $table) {
            $table->bigIncrements('id_plantilla_tecnico');
            $table->integer('id_torneo')->nullable()->default(0);
            $table->string('folio')->nullable();
            $table->string('nombre')->nullable();
            $table->string('puesto')->nullable();
            $table->string('sexo')->nullable();
            $table->string('edad')->nullable();
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
        Schema::dropIfExists('tbl_plantilla_cuerpo_tecnico');
    }
}
