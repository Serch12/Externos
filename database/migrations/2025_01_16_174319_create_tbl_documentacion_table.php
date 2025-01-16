<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDocumentacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_documentacion', function (Blueprint $table) {
            $table->bigIncrements('id_documentacion');
            $table->integer('id_perfil')->nullable();
            $table->string('tipo')->nullable();
            $table->text('archivo')->nullable();
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
        Schema::dropIfExists('tbl_documentacion');
    }
}
