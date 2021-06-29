<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function tipoConsulta (Request $request){

        dd($request);

/*         if($tipoConsulta == 1){
            $consulta = json_decode(json_encode(DB::table('restos_pagars')->get()), true);
        }else{
            $consulta = json_decode(json_encode(DB::table('pagamentos_orcamentarios')->get()), true);    
        }
        
        return view($view='guest.index', $data=$consulta); */
    }
}
