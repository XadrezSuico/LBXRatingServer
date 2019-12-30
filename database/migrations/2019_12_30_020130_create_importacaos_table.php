<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("e_automatico")->default(true);
            $table->tinyinteger("tipo_modalidade")->default(1)->comment = "0 - STD;1 - RPD; 2 - BTZ";
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
        Schema::dropIfExists('importacaos');
    }
}
