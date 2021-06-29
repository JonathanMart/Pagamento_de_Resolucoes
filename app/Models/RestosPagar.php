<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestosPagar extends Model
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
        'ano_empenho',
        'num_empenho',
        'num_ordem_pgto',
        'valor_pago_nproces',
        'valor_pago_proces',
        'data_pgto',
        'cod_banco',
        'cod_agencia',
        'conta',
        'dsc_sit_pgto',
        'dsc_municipio',
    ];

}
