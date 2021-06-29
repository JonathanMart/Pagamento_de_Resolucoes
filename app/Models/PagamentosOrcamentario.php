<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentosOrcamentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_ue',
        'nome_ue',
        'ref_contrato',
        'cod_atv',
        'dsc_atv',
        'cod_fonte',
        'cod_procedec',
        'ref_contrato_saida',
        'cod_upg',
        'dsc_upg',
        'id_credor',
        'credor',
        'num_empenho',
        'num_dcto_pgto',        
        'data_pgto',
        'valor_pago_financeiro',
        'cod_banco',
        'cod_agencia',
        'conta',
        'dsc_sit_pgto',
        'dsc_municipio',
    ];
    
}
