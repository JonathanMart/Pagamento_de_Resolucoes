@extends('layouts.main')

@section('title', 'Pagamento de Resoluções: Pagamentos Orçamentários')



@section('content')
<h3>Consulta: Pagamentos Orçamentários</h3>
<hr>

{{-- Formulário de Resposta da Pesquisa --}}

@if(empty($consulta)) <script>alert('A consulta não retornou dado!')</script> @endif

<table id="table" class="table table-striped" style="width: 100%;">
    <thead class="table-primary">
        <tr>
            <th scope="col">Município</th>
            <th scope="col">Cód. Projeto/<br>Atividade</th>
            <th scope="col">Projeto/<br>Atividade</th>
            <th scope="col">Cód. Fonte</th>
            <th scope="col">Cód. UPG</th>
            <th scope="col">UPG</th>	    
            <th scope="col">Nº de Empenho</th>
            <th scope="col">Nº de Documento de Pagamento</th>
            <th scope="col">Data de Pagamento</th>
            <th scope="col">Valor Pago Financeiro</th>
            <th scope="col">Cód. Banco Creditado</th>
            <th scope="col">Cód. Agência Creditada</th>
            <th scope="col">Conta Corrente Creditada</th>
            <th scope="col">Situação da Ordem de Pagamento</th>
            <th scope="col">CNPJ/CPF do Credor</th>
            <th scope="col">Razão Social</th>
            <th scope="col">N° da Resolução</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($consulta as $registro)
            <tr>  
                <td>{{ $registro['dsc_municipio'] }}</td>
                <td>{{ $registro['cod_atv'] }}</td>
                <td>{{ $registro['dsc_atv'] }}</td>
                <td>{{ $registro['cod_fonte'] }}</td>
                <td>{{ $registro['cod_upg'] }}</td>
                <td>{{ $registro['dsc_upg'] ?? 'N/D' }} </td> 
                <td>{{ $registro['num_empenho'] }}</td>
                <td>{{ $registro['num_dcto_pgto'] }}</td>
                @php( $ano = substr($registro['data_pgto'], 0, 4))
                @php( $mes = substr($registro['data_pgto'], 5, 2))
                @php( $dia = substr($registro['data_pgto'], 8, 2))
                <td>{{ $dia . '/' . $mes . '/' . $ano }}</td>
                <td>{{ 'R$ ' . number_format( $registro['valor_pago_financeiro'], $decimals=2, $dec_pont=',', $thousand_sep='.') }}</td> 
                <td>{{ $registro['cod_banco'] }}</td>
                <td>{{ $registro['cod_agencia'] }}</td>
                <td>{{ $registro['conta'] }}</td>
                <td>{{ $registro['dsc_sit_pagamento'] }}</td>
                <td>{{ $registro['id_credor'] }} </td>
                <td>{{ $registro['credor'] }}</td>
                <td>{{ $registro['ref_contrato_saida'] }}</td>
                <td><a href="{{ route('pagamentos-orcamentarios.visualizar', ['id' => $registro['id']]) }}" class="btn btn-primary">Visualizar</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>

<button type="button" class="btn btn-primary" onclick="history.go(-1)"><i class="fas fa-backward"></i>{{ ' '. 'Voltar' }}</button>

<br>

{{-- Javascript para datatable e Mask --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
$(document).ready(function() {
    //DataTable
    $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
           {
	       extend:'csv',
	       text: 'CSV',	
	   },
	   {
	       extend: 'excel',
	       text: 'Excel',	
	   },
	   {
	       extend: 'colvis',
	       text: 'Selecionar Colunas',
	   },      
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
	responsive: true,
	"columnDefs": [
	    {targets: [1, 2, 3, 17], visible: true}, //define as colunas inicialmente visiveis
        { targets: '_all', visible: false }
	]
    });

} );
</script>




@endsection


