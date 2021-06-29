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
        if($tipo_pesquisa == 'restos_pagar'){
            $consulta = json_decode(json_encode(DB::table('restos_pagars')->get()), true);
        }else{
            $consulta = json_decode(json_encode(DB::table('pagamentos_orcamentarios')->get()), true);
        }

        //dd($consulta);
        return view('guest.index')->with('tipoConsulta', $consulta);
    }

    public function search(SearchRequest $request)
    {
        $request_keys = array_keys($request->all()); //chaves do array de request
        $requisicoes = $request->all(); 

        if($requisicoes['tipo_consulta'] == 'restos_pagars'){
            foreach($request_keys as $key){
                if ($key != '_token' && $requisicoes[$key] != null){
                    $consulta = DB::table('restos_pagars')->where($key, $requisicoes[$key]);
                    /* echo $key . ' -> '. $requisicoes[$key];
                    echo "<br>"; */
                }
            }
        }else{
            foreach($request_keys as $key){
                if ($key != '_token' && $requisicoes[$key] != null){
                    $consulta = DB::table('pagamentos_orcamentarios')->where($key, $requisicoes[$key]);
                    /* echo $key . ' -> '. $requisicoes[$key];
                    echo "<br>"; */
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
