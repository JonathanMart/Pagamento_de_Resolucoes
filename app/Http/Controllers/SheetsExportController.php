<?php

namespace App\Http\Controllers;

use App\Exports\SheetExport;

class SheetsExportController extends Controller
{
    public function export()
    {
        return (new SheetExport())->download('modelo.xlsx');
    }
}
