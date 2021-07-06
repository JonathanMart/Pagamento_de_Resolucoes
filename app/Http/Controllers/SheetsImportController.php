<?php

namespace App\Http\Controllers;

use App\Imports\SheetsImport;
use App\Models\BckpPagamentosOrcamentario;
use App\Models\BckpRestosPagar;
use App\Models\RestosPagar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class SheetsImportController extends Controller
{
    public function index()
    {
        /* if(Auth::check()){
            return view('admin.index')->with('table', 'restos_pagars');
        }

        return redirect()->route('admin.loginForm');  */      
        
        return view('admin.index')->with('table', 'restos_pagars');
        
    }
    
    public function store(Request $request)
    {
        $file = $request->file('file');


        //Fazendo backup dos dados nas tabelas de backup
        $dataRP = DB::table('restos_pagars')->get()->toArray();
        foreach ($dataRP as $rowDataRP){
            //dd($rowDataRP);
            $backup = BckpRestosPagar::create([
                'cod_ue' => $rowDataRP->cod_ue,
                'nome_ue' => $rowDataRP->nome_ue,
                'ref_contrato' => $rowDataRP->ref_contrato,
                'cod_atv' => $rowDataRP->cod_atv,
                'dsc_atv' => $rowDataRP->dsc_atv,
                'cod_fonte' => $rowDataRP->cod_fonte,
                'cod_procedec' => $rowDataRP->cod_procedec,
                'ref_contrato_saida' => $rowDataRP->ref_contrato_saida,
                'cod_upg' => $rowDataRP->cod_upg,
                'dsc_upg' => $rowDataRP->dsc_upg,
                'id_credor' => $rowDataRP->id_credor,
                'credor' => $rowDataRP->credor,
                'ano_empenho' => $rowDataRP->ano_empenho,
                'num_empenho' => $rowDataRP->num_empenho,
                'num_ordem_pgto' => $rowDataRP->num_ordem_pgto,
                'valor_pago_nproces' => $rowDataRP->valor_pago_nproces,
                'valor_pago_proces' => $rowDataRP->valor_pago_proces,
                'data_pgto' => $rowDataRP->data_pgto,
                'cod_banco' => $rowDataRP->cod_banco,
                'cod_agencia' => $rowDataRP->cod_agencia,
                'conta' => $rowDataRP->conta,
                'dsc_sit_pgto' => $rowDataRP->dsc_sit_pgto,
                'dsc_municipio' => $rowDataRP->dsc_municipio,
            ]);
        }

        $dataPO = DB::table('pagamentos_orcamentarios')->get()->toArray();
        foreach ($dataPO as $rowDataPO){

            $backup = BckpPagamentosOrcamentario::create([
                'cod_ue' => $rowDataPO->cod_ue,
                'nome_ue' => $rowDataPO->nome_ue,
                'ref_contrato' => $rowDataPO->ref_contrato,
                'cod_atv' => $rowDataPO->cod_atv,
                'dsc_atv' => $rowDataPO->dsc_atv,
                'cod_fonte' => $rowDataPO->cod_fonte,
                'cod_procedec' => $rowDataPO->cod_procedec,
                'ref_contrato_saida' => $rowDataPO->ref_contrato_saida,
                'cod_upg' => $rowDataPO->cod_upg,
                'dsc_upg' => $rowDataPO->dsc_upg,
                'id_credor' => $rowDataPO->id_credor,
                'credor' => $rowDataPO->credor,
                'num_empenho' => $rowDataPO->num_empenho,
                'num_dcto_pgto' => $rowDataPO->num_dcto_pgto,        
                'data_pgto' => $rowDataPO->data_pgto,
                'valor_pago_financeiro' => $rowDataPO->valor_pago_financeiro,
                'cod_banco' => $rowDataPO->cod_banco,
                'cod_agencia' => $rowDataPO->cod_agencia,
                'conta' => $rowDataPO->conta,
                'dsc_sit_pgto' => $rowDataPO->dsc_sit_pgto,
                'dsc_municipio' => $rowDataPO->dsc_municipio,
            ]);

        }
        
        //Apgando dados existentes nas tabelas
        DB::table('pagamentos_orcamentarios')->truncate();
        DB::table('restos_pagars')->truncate();
        
        //importando dados para as tabelas
        Excel::import(new SheetsImport, $file);
        
        return back()->withStatus('Importado com sucesso');
    }

    public function tablePagamentosOrcamentarios()
    {
        return view('admin.index')->with('table', 'pagamentos_orcamentarios');
    }

    /* public function showLoginForm()
    {
        return view('admin.formLogin');
    }

     public function login(Request $request)
    {
        var_dump($request->all());
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credentials)){
            return redirect()->route('admin.index');
        }

        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.loginForm');
    } */
}
