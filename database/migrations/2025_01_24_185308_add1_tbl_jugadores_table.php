<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add1TblJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_jugadores', function (Blueprint $table) {
            
            $table->string('tutor')->nullable()->after('edad');
            $table->string('correo')->nullable()->after('tutor');
            $table->string('telefono')->nullable()->after('correo');
            $table->text('direccion')->nullable()->after('correo');
            
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
