<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTblPlantillaJugadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_plantilla_jugador', function (Blueprint $table) {
            $table->integer('num_dorsal')->nullable()->default(0)->after("folio")->nullable();
            $table->integer('prestamo')->nullable()->default(0)->after("sede")->nullable();
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
