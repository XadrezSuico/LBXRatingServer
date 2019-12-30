<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger("importacaos_id")->unsigned();
            $table->foreign("importacaos_id")->references("id")->on("importacaos");

            $table->integer("lbx_id");
            $table->string("nome")->comment="Apenas a parte de nome do arquivo";
            $table->string("sobrenome")->comment="Apenas a parte de sobrenome do arquivo";
            $table->string("nome_completo")->comment="Apresentação do nome da forma padrão que utilizamos";
            $table->string("nome_arquivo")->comment="O nome da forma que veio do arquivo";
            $table->string("sexo")->nullable();
            $table->string("fed")->nullable();
            $table->string("codigo_cidade")->nullable();
            $table->string("nome_cidade");
            $table->date("nascimento")->nullable();
            $table->integer("rating")->nullable();
            $table->integer("k");
            $table->tinyinteger("tipo_modalidade")->comment = "0 - STD;1 - RPD; 2 - BTZ";
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
        Schema::dropIfExists('ratings');
    }
}
