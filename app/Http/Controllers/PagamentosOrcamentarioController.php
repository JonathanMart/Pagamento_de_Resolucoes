<?php

namespace App\Http\Controllers;

use App\Models\PagamentosOrcamentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagamentosOrcamentarioController extends Controller
{
    /**
     * Pagina inicial dos Pagamentos Orcamentarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagamentos-orcamentarios.index');
    }

    /**
     * Realiza a consulta.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
     
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
    
}
