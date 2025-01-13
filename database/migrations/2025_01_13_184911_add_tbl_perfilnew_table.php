<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTblPerfilnewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_perfil', function (Blueprint $table) {
            DB::statement("ALTER TABLE tbl_perfil MODIFY COLUMN telefono VARCHAR(255)");
            $table->date('cumpleaños')->nullable()->after('telefono');
            $table->integer('id_documentos')->default(0)->nullable()->after('sede');
            
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
