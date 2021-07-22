<?php

namespace App\Imports;

use App\Models\PagamentosOrcamentario;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class PagamentosOrcamentarioImport implements ToModel
{

    public function model(array $row)
    {
        if(!isset($row[0]) || ($row[0]=='Unidade Executora - Código/Nome')){
            return null;
        }
   
        return new PagamentosOrcamentario([
            'cod_ue' => intval(substr($row[0], 0, 7)),
            'nome_ue' => substr($row[0], 14, strlen($row[0])),
            'ref_contrato' => $row[1],
            'cod_atv' => $row[2],
            'dsc_atv' => $row[3],
            'cod_fonte' => $row[4],
            'cod_procedec' => $row[5],
            'ref_contrato_saida' => $row[6],
            'cod_upg' => $row[7],
            'dsc_upg' => $row[8],
            'id_credor' => $row[9],
            'credor' => $row[10],
            'num_empenho' => $row[11],
            'num_dcto_pgto' => $row[12],
            'data_pgto' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]),
            'valor_pago_financeiro' => $row[14],
            'cod_banco' => $row[15],
            'cod_agencia' => $row[16],
            'conta' => $row[17],
            'dsc_sit_pgto' => $row[18],
            'dsc_municipio' => $row[19],
        ]);
    }
}
