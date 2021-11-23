<?php

namespace App\Http\Controllers;

use App\Imports\SheetsImport;
use App\Imports\SheetsImportOld;
use App\Models\BckpPagamentosOrcamentario;
use App\Models\BckpRestosPagar;
use App\Models\RestosPagar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class SheetsImportController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            if(isset($_GET['aba']) and ($_GET['aba'] == 'download')){
                return view('admin.index')
                    ->with('table', 'restos_pagars')
                    ->with('aba', 'download');
            }else{
                return view('admin.index')
                    ->with('table', 'restos_pagars')
                    ->with('aba', 'upload');
            }
        }

        return redirect()->route('loginForm');        
        
        //return view('admin.index')->with('table', 'restos_pagars');
    }
    
    public function store(Request $request)
    {
        $file = $request->file('file');
        
        /**
         * Importação de dados
         */

        //importando dados para as tabelas
        Excel::import(new SheetsImport, $file);
        
        return back()->withStatus('Importado com sucesso');
    }

    public function tablePagamentosOrcamentarios()
    {
        return view('admin.index')->with('table', 'pagamentos_orcamentarios')->with('aba', 'upload');
    }

}
