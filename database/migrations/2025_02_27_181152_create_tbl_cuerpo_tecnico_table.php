<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCuerpoTecnicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cuerpo_tecnico', function (Blueprint $table) {
            $table->bigIncrements('id_cuerpo_tecnico');
            $table->integer('creacion')->nullable();
            $table->string('folio')->nullable();
            $table->text('foto')->nullable();
            $table->string('nombre')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('puesto')->nullable();
            $table->string('sexo')->nullable();
            $table->string('sede')->nullable();
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
        Schema::dropIfExists('tbl_cuerpo_tecnico');
    }
}
