<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTblPerfilDropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('tbl_perfil', function (Blueprint $table) {
            DB::statement("ALTER TABLE tbl_perfil DROP COLUMN sede");
            DB::statement("ALTER TABLE tbl_perfil DROP COLUMN id_documentos");
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
