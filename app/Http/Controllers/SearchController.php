<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function tipoConsulta($tipo_pesquisa)
    {
        if($tipo_pesquisa == '1'){
            //$consulta = json_decode(json_encode(DB::table('restos_pagars')->get()), true);
            $consulta = 1;
        }else{
            //$consulta = json_decode(json_encode(DB::table('pagamentos_orcamentarios')->get()), true);
            $consulta = 2;
        }

        //dd($consulta);
        return view('guest.index')->with('tipoConsulta', $consulta);
    }

    public function search(Request $request)
    {
        $request_keys = array_keys($request->all()); //chaves do array de request
        $requisicoes = $request->all(); 

            
        if($requisicoes['tipo_consulta'] == "Pagamentos de Restos a Pagar"){
            foreach($request_keys as $key){
                if ($key != ('_token' or 'tipo_consulta') or $requisicoes[$key] != null){
                    $consulta = DB::table('restos_pagars')->where($key, $requisicoes[$key]);
                }
            }
        }else{
            foreach($request_keys as $key){
                if ($key != '_token' && $requisicoes[$key] != null){
                    $consulta = DB::table('pagamentos_orcamentarios')->where($key, $requisicoes[$key]);
                }
            }
        }
        
        $query = json_decode(json_encode($consulta->get()), true);

        //dd($query);

        return view('guest.index')->with('consulta', $query);
    }

    public function show($id){

        $registro = json_decode(json_encode(DB::table('restos_pagars')->find($id)), true);
        //var_dump($registro);
        return view($view='guest.show', $data=$registro);
    }
}
