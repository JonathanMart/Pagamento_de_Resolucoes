<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function index()
    {
        $array_totais = [

            'valor_pago_financeiro' => DB::table('pagamentos_orcamentarios')->sum('valor_pago_financeiro'),
        
            'valor_pago_processado' => DB::table('restos_pagars')->sum('valor_pago_proces'),
    
            'valor_pago_nao_processado' => DB::table('restos_pagars')->sum('valor_pago_nproces'),
        ];

        
        return view('guest.index', $data = $array_totais);
    }

    public function contraste()
    {
        //
    }

    public function perguntas_frequentes()
    {
        //
    }


    public function contatos()
    {
        return view('guest.contato');
    }

    public function utilizacao_do_pagamento_de_resolucoes()
    {
        //
    }

}
