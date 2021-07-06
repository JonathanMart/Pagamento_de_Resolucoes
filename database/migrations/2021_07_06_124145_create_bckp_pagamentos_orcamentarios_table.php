<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBckpPagamentosOrcamentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bckp_pagamentos_orcamentarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cod_ue')->nullable(); //row[0]
            $table->string('nome_ue')->nullable(); //row[0]
            $table->string('ref_contrato')->nullable(); //row[1]
            $table->unsignedBigInteger('cod_atv')->nullable(); //row[2]
            $table->string('dsc_atv')->nullable(); //row[3]
            $table->unsignedBigInteger('cod_fonte')->nullable();
            $table->unsignedBigInteger('cod_procedec')->nullable();
            $table->string('ref_contrato_saida')->nullable();
            $table->unsignedBigInteger('cod_upg')->nullable();
            $table->string('dsc_upg')->nullable();
            $table->string('id_credor')->nullable();
            $table->string('credor')->nullable();
            $table->unsignedBigInteger('num_empenho')->nullable();
            $table->unsignedBigInteger('num_dcto_pgto')->nullable();        
            $table->date('data_pgto')->nullable();
            $table->double('valor_pago_financeiro')->nullable();
            $table->string('cod_banco')->nullable();
            $table->string('cod_agencia')->nullable();
            $table->string('conta')->nullable();
            $table->string('dsc_sit_pgto')->nullable();
            $table->string('dsc_municipio')->nullable();

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
        Schema::dropIfExists('bckp_pagamentos_orcamentarios');
    }
}
