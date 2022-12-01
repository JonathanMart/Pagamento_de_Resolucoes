<?php

namespace App\Http\Controllers;

use App\Models\PagamentosOrcamentario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PagamentosOrcamentarioController extends Controller
{
    /**
     * Pagina inicial dos Pagamentos Orcamentarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anos_pagamento = $this->getAllYears();

        $municipios = $this->getAllMunicipios();

        $projeto_atividade = $this->getAllProjetoAtividade();
        
        $upg = $this->getAllUpg();

        #dd($anos_pagamento, $municipios, $projeto_atividade, $upg);

        return view('pagamentos-orcamentarios.index')
            ->with('anos_pagamento', $anos_pagamento)
            ->with('municipios', $municipios)
            ->with('projetos_atividades', $projeto_atividade)
            ->with('upg', $upg); 
    }

    /**
     * Realiza a consulta.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
	
	$messages = [
		'data_pgto.required'     => 'O campo Ano de Pagamento é obrigatótio',
		'dsc_municipio.required' => 'O campo municipio é obrigatório' 
	];	

	$rules = [
		'data_pgto'     => 'required',
		'dsc_municipio' => 'required'
	];

	$request->validate($rules, $messages);
        
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
                   
        $resultado = $query->get();        

        return view('pagamentos-orcamentarios.consulta')->with('consulta', $resultado);
 
    }

    public function visualizar($id)
    {
        $registro = json_decode(json_encode(DB::table('pagamentos_orcamentarios')->find($id)), true);

        return view('pagamentos-orcamentarios.visualizar', $data=$registro);
    }
    
    private function getAllYears()
    {
        $datas = PagamentosOrcamentario::pluck('data_pgto')->unique();

        foreach($datas as $data){
            $anos[] = Carbon::createFromFormat('Y-m-d', $data)->year;
        }
        
        sort($anos);

        return array_unique($anos);
    }

    private function getAllMunicipios()
    {
        $municipios = PagamentosOrcamentario::pluck('dsc_municipio')->unique()->toArray();
        
        sort($municipios);

        return $municipios;
    }

    private function getAllProjetoAtividade()
    {
        $codigos = PagamentosOrcamentario::pluck('cod_atv')->unique();

        foreach($codigos as $codigo){
            $projetos_atividades[$codigo] = $this->getProjetoAtividade($codigo);
        }

        ksort($projetos_atividades);
        
        return $projetos_atividades;        
    }

    private function getProjetoAtividade($cod_atv)
    {
        return PagamentosOrcamentario::where('cod_atv', $cod_atv)->value('dsc_atv');
    }

    private function getAllUpg()
    {
        $codigos = PagamentosOrcamentario::pluck('cod_upg')->unique();
        
        foreach ($codigos as $codigo){
            $upg[$codigo] = $this->getUpg($codigo);
        }

        ksort($upg);

        return $upg;
    }

    private function getUpg($cod_upg)
    {
        return PagamentosOrcamentario::where('cod_upg', $cod_upg)->value('dsc_upg');
    }

}
