<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTblJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_jugadores', function (Blueprint $table) {
            $table->string('posicion')->nullable()->after('fecha_nacimiento');
            $table->string('apodo')->nullable()->after('posicion');
            $table->string('sexo')->nullable()->after('apodo');
            
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
