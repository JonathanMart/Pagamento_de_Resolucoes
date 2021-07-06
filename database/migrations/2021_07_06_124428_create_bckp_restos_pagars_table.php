<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBckpRestosPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bckp_restos_pagars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cod_ue')->nullable();
            $table->string('nome_ue')->nullable();
            $table->string('ref_contrato')->nullable();
            $table->unsignedInteger('cod_atv')->nullable();
            $table->string('dsc_atv')->nullable();
            $table->unsignedInteger('cod_fonte')->nullable();
            $table->unsignedInteger('cod_procedec')->nullable();
            $table->string('ref_contrato_saida')->nullable();
            $table->unsignedBigInteger('cod_upg')->nullable();
            $table->string('dsc_upg')->nullable();
            $table->string('id_credor')->nullable(); //cpf ou cnpj
            $table->string('credor')->nullable(); //razão social do credor
            $table->year('ano_empenho')->nullable(); //date->ano
            $table->unsignedBigInteger('num_empenho')->nullable();
            $table->unsignedBigInteger('num_ordem_pgto')->nullable();
            $table->double('valor_pago_nproces')->nullable();
            $table->double('valor_pago_proces')->nullable();
            $table->date('data_pgto')->nullable();
            $table->string('cod_banco')->nullable();
            $table->string('cod_agencia')->nullable();
            $table->string('conta')->nullable();
            $table->string('dsc_sit_pgto')->nullable(); //descricao da situacao da ordem de pagamentos
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
        Schema::dropIfExists('bckp_restos_pagars');
    }
}
