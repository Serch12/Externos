<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDatosFacturacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_datos_facturacion', function (Blueprint $table) {
            $table->integer('id_facturacion');
            $table->integer('id')->nullable();
            $table->text('razon_social')->nullable();
            $table->text('rfc')->nullable();
            $table->text('regimen')->nullable();
            $table->text('cfdi')->nullable();
            $table->text('direccion')->nullable();
            $table->text('num_ext')->nullable();            
            $table->integer('cp')->nullable();
            $table->text('colonia')->nullable();
            $table->text('municipio')->nullable();
            $table->text('estado')->nullable();
            $table->text('pais')->nullable();
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
        Schema::dropIfExists('tbl_datos_facturacion');
    }
}
