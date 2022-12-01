<?php

namespace App\Http\Controllers;

use App\Models\PagamentosOrcamentario; 
use App\Models\RestosPagar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function index()
    {

	$ano_atual = date('Y'); 

	$valor_pago_financeiro = PagamentosOrcamentario::whereYear('data_pgto', $ano_atual)->sum('valor_pago_financeiro'); 

	$valor_pago_processado = RestosPagar::whereYear('data_pgto', $ano_atual)->sum('valor_pago_proces'); 

	$valor_pago_nao_processado = RestosPagar::whereYear('data_pgto', $ano_atual)->sum('valor_pago_nproces');
	

        $array_totais = [

            'valor_pago_financeiro' => $valor_pago_financeiro,
        
            'valor_pago_processado' => $valor_pago_processado,
    
            'valor_pago_nao_processado' => $valor_pago_nao_processado,
        ];

        
        return view('guest.index', $data = $array_totais);
    }

    public function contraste()
    {
        //
    }

    public function perguntas_frequentes()
    {
        return view('guest.perguntas-frequentes');
    }


    public function contatos()
    {
        return view('guest.contato');
    }

    public function utilizacao_do_pagamento_de_resolucoes()
    {
        return view('guest.utilizacao-pagamento-resolucoes');
    }

    public function outros_sistemas()
    {
        return view('guest.outros-sistemas');
    }

}
