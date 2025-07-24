<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblContratosDigital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contratos_digital', function (Blueprint $table) {
            $table->bigIncrements('id_contrato_digital');
            $table->integer('id_usuario');
            $table->string('nacionalidad')->nullable();
            $table->string('sexo')->nullable();
            $table->integer('edad')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profesion')->nullable();
            $table->string('cedula_profesional')->nullable();
            $table->string('domicilio')->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->string('entidad')->nullable();
            $table->string('RFC')->nullable();
            $table->string('curp')->nullable();
            $table->string('puesto_desempenar')->nullable();
            $table->decimal('salario_numero',10,2)->nullable();
            $table->string('salario_texto')->nullable();
            $table->date('fecha_antiguedad')->nullable();
            $table->date('fecha_firma_contrato')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('actividades_realizar')->nullable();
            $table->string('tipo_contrato')->nullable();
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
        Schema::dropIfExists('tbl_contratos_digital');
    }
}
