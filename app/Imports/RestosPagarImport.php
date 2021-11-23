<?php

namespace App\Imports;

use App\Models\RestosPagar;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class RestosPagarImport implements ToModel, WithBatchInserts, WithChunkReading
{
   
    public function model(array $row)
    {
        
        //Pulando linhas em branco e de cabeçalho
        if(!isset($row[0]) || ($row[0]=='Unidade Executora - Código/Nome') || $row[0]=='Ano'){
            return null;
        }

        return new RestosPagar([
            'cod_ue' => intval(substr($row[0], 0, 7)),
            'nome_ue' => substr($row[0], 14, strlen($row[0])),
            'ref_contrato' => isset($row[1]) ? $row[1] : NULL,
            'cod_atv' => $row[2],
            'dsc_atv' => $row[3],
            'cod_fonte' => $row[4],
            #'cod_procedec' => $row[5],
            'ref_contrato_saida' => $row[5],
            'cod_upg' => $row[6],
            'dsc_upg' => $row[7],
            'id_credor' => $row[8],
            'credor' => $row[9],
            'ano_empenho' => $row[10],
            'num_empenho' => $row[11],
            'num_ordem_pgto' => $row[12],
            'valor_pago_nproces' => $row[13],
            'valor_pago_proces' => $row[14],
            'data_pgto' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15]),
            'cod_banco' => $row[16],
            'cod_agencia' => $row[17],
            'conta' => $row[18],
            'dsc_sit_pgto' => $row[19],
            'dsc_municipio' => $row[20],
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
