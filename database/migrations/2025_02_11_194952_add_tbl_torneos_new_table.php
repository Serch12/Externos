<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTblTorneosNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_torneo', function (Blueprint $table) {
            $table->integer('id_proveedor')->default(0)->after("copa")->nullable();
            $table->decimal('subtotal', 10, 2)->after("id_proveedor")->nullable();
            $table->decimal('total', 10, 2)->after("subtotal")->nullable();
            $table->text('archivo')->after("total")->nullable();
            DB::statement("DROP TABLE IF EXISTS tbl_datos_bancarios");
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
