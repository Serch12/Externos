<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTblPerfilNewCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_perfil', function (Blueprint $table) {
            
            $table->date('fecha_ingreso')->nullable()->after("apellido_materno")->nullable();
            $table->string('estado_civil')->nullable()->after("fecha_ingreso")->nullable();
            $table->string('sexo')->nullable()->after("estado_civil")->nullable();
            $table->string('nacionalidad')->nullable()->after("sexo")->nullable();
            $table->string('profesion')->nullable()->after("nacionalidad")->nullable();
            $table->string('puesto')->nullable()->after("profesion")->nullable();
            $table->string('no_imss')->nullable()->after("puesto")->nullable();
            $table->string('cedula')->nullable()->after("no_imss")->nullable();
            $table->string('curp')->nullable()->after("cedula")->nullable();
            $table->string('rfc')->nullable()->after("curp")->nullable();
            $table->integer('year')->nullable()->after("cumpleaños")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
