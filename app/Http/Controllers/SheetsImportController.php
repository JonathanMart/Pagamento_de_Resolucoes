<?php

namespace App\Http\Controllers;

use App\Imports\SheetsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class SheetsImportController extends Controller
{
    public function index()
    {
        return view('admin.index')->with('table', 'restos_pagars');
    }
    
    public function store(Request $request)
    {
        $file = $request->file('file');

        DB::table('pagamentos_orcamentarios')->delete();
        DB::table('restos_pagars')->delete();
        
        Excel::import(new SheetsImport, $file);
        
        return back()->withStatus('Importado com sucesso');
    }

    public function tablePagamentosOrcamentarios(){
        return view('admin.index')->with('table', 'pagamentos_orcamentarios');
    }
}
