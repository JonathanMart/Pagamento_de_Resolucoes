<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class RestosPagarExport implements FromArray, WithTitle
{

    use Exportable;

    public function array(): array
    {
        return [

            ['Unidade Executora - Código/Nome',	
            'Num Ref ContratoConvênio Entrada',	
            'Projeto_Atividade - Código',	
            'Projeto_Atividade - Descrição',	
            'Fonte Recurso - Código	Procedência - Código',	
            'Num Ref ContratoConvênio Saída',	
            'Unid Programação Gasto - Código',
            'Unid Programação Gasto - Descrição',	
            'CNPJ_CPF Credor - Formatado',	
            'Razão Social Credor',	
            'Ano Origem Empenho',
            'Número Empenho',	
            'Número Ordem Pagamento',	
            'Valor Pago Não Processado',	
            'Valor Pago Processado',	
            'Data Pagamento',	
            'Banco Creditado - Código',	
            'Agência Creditada - Código',	
            'Conta Bancária Creditada',	
            'Situação Ordem Pagamento -Descrição',	
            'Município Credor - Descrição']

        ];
    }

    public function title(): string
    {
        return 'Pagamentos 2021 Restos a Pagar';
    }

}
