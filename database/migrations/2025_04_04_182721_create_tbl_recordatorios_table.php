<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRecordatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_recordatorios', function (Blueprint $table) {
            $table->bigIncrements('id_recordario');
            $table->integer('id_user')->nullable();
            $table->string('titulo')->nullable();
            $table->date('fecha_inicia')->nullable();
            $table->date('fecha_termina')->nullable();
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('tbl_recordatorios');
    }
}
