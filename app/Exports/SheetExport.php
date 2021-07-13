<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        $sheets [] = new RestosPagarExport();
        $sheets [] = new PagamentosOrcamentariosExport();
        
        return $sheets;
    }
}
