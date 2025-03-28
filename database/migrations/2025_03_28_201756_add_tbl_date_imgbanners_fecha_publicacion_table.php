<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTblDateImgbannersFechaPublicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_date_imgbanners', function (Blueprint $table) {
            $table->date('fecha_publicacion')->nullable()->after("img_banner")->nullable();
            DB::statement("ALTER TABLE tbl_date_imgbanners DROP COLUMN id_banner");
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
