<?php

namespace App\Imports;

use App\Models\PagamentosOrcamentario;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PagamentosOrcamentarioImport implements ToModel, WithBatchInserts, WithChunkReading
{

    public function model(array $row)
    {
        if(!isset($row[0]) || ($row[0]=='Unidade Executora - Código/Nome')){
            return null;
        }
   
        return new PagamentosOrcamentario([
            'cod_ue' => intval(substr($row[0], 0, 7)),
            'nome_ue' => substr($row[0], 14, strlen($row[0])),
            #'ref_contrato' => isset($row[1]) ? $row[1] : NULL,
            'cod_atv' => $row[1],
            'dsc_atv' => $row[2],
            'cod_fonte' => $row[3],
            'cod_procedec' => $row[4],
            'ref_contrato_saida' => $row[5],
            'cod_upg' => $row[6],
            'dsc_upg' => $row[7],
            'id_credor' => $row[8],
            'credor' => $row[9],
            'num_empenho' => $row[10],
            'num_dcto_pgto' => $row[11],
            'data_pgto' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]),
            'valor_pago_financeiro' => $row[13],
            'cod_banco' => $row[14],
            'cod_agencia' => $row[15],
            'conta' => $row[16],
            'dsc_sit_pgto' => $row[17],
            'dsc_municipio' => $row[18],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}
