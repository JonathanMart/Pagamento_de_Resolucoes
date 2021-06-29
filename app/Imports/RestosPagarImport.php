<?php

namespace App\Imports;

use App\Models\RestosPagar;
use Maatwebsite\Excel\Concerns\ToModel;

class RestosPagarImport implements ToModel
{
    
    public function model(array $row)
    {
        if(!isset($row[0]) || ($row[0]=='Unidade Executora - Código/Nome')){
            return null;
        }

        return new RestosPagar([
            'cod_ue' => intval(substr($row[0], 0, 7)),
            'nome_ue' => substr($row[0], 7, strlen($row[0])),
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
            'ano_empenho' => $row[11],
            'num_empenho' => $row[12],
            'num_ordem_pgto' => $row[13],
            'valor_pago_nproces' => $row[14],
            'valor_pago_proces' => $row[15],
            'data_pgto' => date('Y-m-d', (int) $row[16]),
            'cod_banco' => $row[17],
            'cod_agencia' => $row[18],
            'conta' => $row[19],
            'dsc_sit_pgto' => $row[20],
            'dsc_municipio' => $row[21],
        ]);
    }
}
