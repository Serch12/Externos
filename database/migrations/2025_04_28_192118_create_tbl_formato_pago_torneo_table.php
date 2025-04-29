<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFormatoPagoTorneoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_formato_pago_torneo', function (Blueprint $table) {
            $table->bigIncrements('id_formato');
            $table->integer('creacion')->nullable();
            $table->string('nombre')->nullable();
            $table->string('rfc')->nullable();
            $table->string('banco')->nullable();
            $table->string('cuenta_bancaria')->nullable();
            $table->string('clabe_bancaria')->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('ejecutivo')->nullable();
            $table->decimal('subtotal', 10, 2)->nullable()->default(0.00);
            $table->decimal('total', 10, 2)->nullable()->default(0.00);
            $table->string('tipo_persona')->nullable();
            $table->string('inscripcion')->nullable();
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
        Schema::dropIfExists('tbl_formato_pago_torneo');
    }
}
