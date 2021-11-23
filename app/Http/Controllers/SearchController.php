<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest;
use App\Models\PagamentosOrcamentario; 
use App\Models\RestosPagar;

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

	if($request->tipo_consulta == 'Pagamentos de Restos a Pagar'){
		
		$tabela = 1;
	
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
	}else{

		$tabela = 2;
		
		$query = PagamentosOrcamentario::query();
		$termos_consulta = $request->only('data_pgto', 'ref_contrato_saida', 'cod_ue', 'dsc_municipio', 'cod_atv', 'cod_upg', 'id_credor', 'credor', 'conta');

		foreach($termos_consulta as $nome => $valor){
			if($valor){
				if($nome == 'data_pgto'){
					$query->whereYear($nome, $valor);
				}elseif($nome == 'id_credor'){
					$valor = preg_replace('/[^0-9]/', '', $valor);
						$query->where($nome, $valor);
				}elseif($nome == 'credor'){
					$valor = strtoupper($valor);
					//dd($valor);
					$query->where($nome, $valor);
				}else{
					$query->where($nome, $valor);
				}
			}
		}
	}      
	
	$resultado = $query->get();        

	return view('guest.index')->with('consulta', $resultado)->with('tabela', $tabela);
    }

    public function show($tipo_consulta, $id){
	
	if($tipo_consulta == 1){
	    $registro = json_decode(json_encode(DB::table('restos_pagars')->find($id)), true);    	
	} elseif($tipo_consulta == 2){
	   $registro = json_decode(json_encode(DB::table('pagamentos_orcamentarios')->find($id)), true);
        }
        return view($view='guest.show', $data=$registro, $mergeData=array('tipo_consulta' => $tipo_consulta));
    }
}
