<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetsImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array
    {
        return [
            'Pagamentos 2021 Restos a Pagar' => new RestosPagarImport(),
            'Pagamentos Orçamentários 2021' => new PagamentosOrcamentarioImport(),
        ];
    }
}