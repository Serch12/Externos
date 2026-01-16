<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblRegistroJugador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_registro_jugador', function (Blueprint $table) {
            $table->bigIncrements('id_registro_jugador');
            $table->string('nombre')->nullable();
            $table->string('lugar_visoria')->nullable();
            $table->integer('edad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('posicion')->nullable();
            $table->string('perfil')->nullable();
            $table->string('estatura')->nullable();
            $table->string('peso')->nullable();
            $table->string('tiempo_jugando')->nullable();
            $table->string('equipos_jugando')->nullable();
            $table->string('profesional_amateur')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('escuela')->nullable();
            $table->string('persona_recomienda')->nullable();
            $table->string('enfermedad')->nullable();
            $table->string('terminos')->nullable();
            $table->string('solicitud_dinero')->nullable();
            $table->string('nombre_quien_pago')->nullable();
            $table->string('formato_firmado')->nullable();
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
        //
    }
}
