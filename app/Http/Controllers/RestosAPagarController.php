<?php

namespace App\Http\Controllers;

use App\Models\RestosPagar;
use Carbon\Carbon;
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
        $anos_empenho = $this->getAllYearEmpenho();

        $anos_pagamento = $this->getAllYearPagamento();

        $municipios = $this->getAllMunicipios();

        $projeto_atividade = $this->getAllProjetoAtividade();
        
        $upg = $this->getAllUpg();

        // $conta = $this->getAllConta();

        return view('pagamentos-restos-a-pagar.index')
            ->with('anos_empenho', $anos_empenho)
            ->with('anos_pagamento', $anos_pagamento)
            ->with('municipios', $municipios)
            ->with('projetos_atividades', $projeto_atividade)
            ->with('upg', $upg);
            // ->with('conta', $conta);
    }

    /**
     * Realiza a consulta.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
	
	$rules = [
		// 'ano_empenho'   => 'required', 
		// 'data_pgto'     => 'required', 
		'dsc_municipio' => 'required',
		'conta' => 'required', 
	];

	$messages = [
		// 'ano_empenho.required'   => 'O campo ano de empenho é obrigatório', 
		// 'data_pgto.required'     => 'O campo data de pagamento é obrigatório', 
		'dsc_municipio.required' => 'O campo municipio é obrigatório', 

		'conta.required' => 'O campo conta corrente é obrigatório', 
	];        

	$request->validate($rules, $messages);
	
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

    private function getAllYearEmpenho()
    {
        $anos = RestosPagar::pluck('ano_empenho')->unique()->toArray();

        sort($anos);

        return $anos;
    }

    private function getAllYearPagamento()
    {
        $datas = RestosPagar::pluck('data_pgto')->unique();

        foreach($datas as $data){
            $anos[] = Carbon::createFromFormat('Y-m-d', $data)->year;
        }
        
        sort($anos);

        return array_unique($anos);
    }

    private function getAllMunicipios()
    {
        $municipios = RestosPagar::pluck('dsc_municipio')->unique()->toArray();
        
        sort($municipios);

        return $municipios;
    }

    private function getAllProjetoAtividade()
    {
        $codigos = RestosPagar::pluck('cod_atv')->unique();

        foreach($codigos as $codigo){
            $projetos_atividades[$codigo] = $this->getProjetoAtividade($codigo);
        }

        ksort($projetos_atividades);
        
        return $projetos_atividades;        
    }

    private function getProjetoAtividade($cod_atv)
    {
        return RestosPagar::where('cod_atv', $cod_atv)->value('dsc_atv');
    }

    private function getAllUpg()
    {
        $codigos = RestosPagar::pluck('cod_upg')->unique();
        
        foreach ($codigos as $codigo){
            $upg[$codigo] = $this->getUpg($codigo);
        }

        ksort($upg);

        return $upg;
    }

    private function getUpg($cod_upg)
    {
        return RestosPagar::where('cod_upg', $cod_upg)->value('dsc_upg');
    }

}
