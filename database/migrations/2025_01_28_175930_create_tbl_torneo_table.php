<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTorneoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_torneo', function (Blueprint $table) {
            $table->bigIncrements('id_torneo');
            $table->string('torneo')->nullable();
            $table->string('categoria')->nullable();
            $table->string('sede')->nullable();
            $table->date('fecha_inicia')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->text('contacto')->nullable();
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
        Schema::dropIfExists('tbl_torneo');
    }
}
