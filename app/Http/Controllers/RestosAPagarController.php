<?php

namespace App\Http\Controllers;

use App\Models\RestosPagar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestosAPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagamentos-restos-a-pagar.index');
    }

    /**
     * Realiza a consulta.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = RestosPagar::query();
		$termos_consulta = $request->only('ano_empenho', 'data_pgto', 'ref_contrato_saida', 'cod_ue', 'dsc_municipio', 'cod_atv', 'cod_upg', 'id_credor', 'credor', 'conta');
		
		foreach($termos_consulta as $nome => $valor){
			if($valor){
				if($nome == 'data_pgto'){
					$query->whereYear($nome, $valor);
				}elseif($nome == 'id_credor'){
					#$valor = preg_replace('/[^0-9]/', '', $valor);
					$query->where($nome, $valor);
				}elseif($nome == 'credor'){
					$valor = strtoupper($valor);
					$query->where($nome, $valor);
				}else{
					$query->where($nome, $valor); 
				}
			}
		}

        $resultado = $query->get();        
    
        return view('pagamentos-restos-a-pagar.consulta')->with('consulta', $resultado);
    }

    public function visualizar($id)
    {
        $registro = json_decode(json_encode(DB::table('restos_pagars')->find($id)), true);

        return view('pagamentos-restos-a-pagar.visualizar', $data=$registro);
    }

}
