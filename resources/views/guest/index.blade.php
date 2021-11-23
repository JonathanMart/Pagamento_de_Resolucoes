@extends('layouts.main')

@section('title', 'Pagamento de Resoluções')

@php($tabela_consulta = 0)

@section('content')
<h3>Pagamento de Resoluções</h3>
<hr>

{{-- Card de informação --}}
<div class="card text-white bg-info mb-3">
  <div class="card-header">Instruções</div>
  <div class="card-body">
    <!-- <p class="card-text">Os campos com <strong style="color: red;">*</strong> são de preenchimento obrigatório</p> -->
    <p class="card-text">Para gerar sua consulta, siga os seguintes passos:</p>
    <ol class="card-text">
        <li>Clique no tipo de consulta que deseja realizar (Pagamento de Restos a Pagar ou Pagamentos Orçamentários)</li>
        <li>Filtre os dados de acordo com o tipo de consulta que deseja gerar. <strong>Não é obrigatório preencher todos os filtros</strong></li>
        <li>Clique no botão Consultar para gerar a consulta</li>
        <li>Será exibida uma tabela com os dados de acordo com os filtros selecionados</li>
        <li>Caso queira maiores detalhes sobre determinada consulta, clique no botão Visualizar</li>
        <li>Existe também a opção de exportar os dados em formato CSV ou XLSX (Excel), clicando nos botões que estão dispostos no canto superior direito da tabela </li>
    </ol>
  </div>
</div>

{{-- Selecionar o tipo de pesquisa --}}
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <a href="{{ route('guest.tipoConsulta', ['tipo' => '1']) }}" class="btn btn-primary">Pagamentos de Restos a Pagar</a>
    </div>
    <div class="col-md-auto">
        <a href="{{ route('guest.tipoConsulta', ['tipo' => '2']) }}" class="btn btn-success">Pagamentos Orçamentários</a>
    </div>
</div>

<br>

@if(isset($tipoConsulta))

{{-- Resgatando dados do BD --}}
@php( $tipoConsulta == 1 ? $registros = DB::table('restos_pagars')->get() : $registros = DB::table('pagamentos_orcamentarios')->get() )
@php( $tipoConsulta == 1 ? $tabela_consulta = 1 : $tabela_consulta = 2 )

{{-- Formulario de Pesquisa --}}
<form action="{{ route('guest.search') }}" method="post">
    @csrf

    <div class="row g-3">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="tipo_consulta" name="tipo_consulta">
                    <option selected>{{ $tipoConsulta == 1 ? 'Pagamentos de Restos a Pagar' : 'Pagamentos Orçamentários'}}</option>
                </select>
                <label for="ano">Tipo da Consulta<strong style="color: red;"> *</strong></label>
            </div>
        </div>
        @if($tipoConsulta == 1)
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ano_empenho" name="ano_empenho">
                    <option value="" selected>Selecione o ano do Empenho</option>
                    @php($anos_empenho = $registros->unique('ano_empenho'))
                    @php($anos_empenho = $anos_empenho->sortBy('ano_empenho'))
                    @foreach($anos_empenho as $registro)
                        <option>{{$registro->ano_empenho}}</option>
                    @endforeach
                </select>
                <label for="ano">Ano do Empenho<strong style="color: red;"> *</strong></label>
            </div>
        </div>
        @endif
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ano_pagamento" name="data_pgto">
                    <option value="" selected>Selecione o ano de Pagamento</option>
                    @php($anos = $registros->unique('data_pgto'))
		    @php($anos = $anos->sortBy('data_pgto'))
                    @php($anos_pgto = array())
		    @foreach($anos as $ano)
		    	@php($anos_pgto[] = substr($ano->data_pgto, 0, 4))
   		    @endforeach
		    @php($anos_pgto_unico = array_unique($anos_pgto))
		    @foreach($anos_pgto_unico as $ano)
                        <option>{{ $ano }}</option>
                    @endforeach
                </select>
                <label for="ano">Ano do Pagamento</label>
            </div>
        </div>
    </div>

    <br>
    
    <div class="row g-2">
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="numeroResolucao" name="ref_contrato_saida" placeholder="Digite o Nº da Resolução">
                <label for="numeroResolucao">Digite o Nº da Resolução (no formato xxxx/xxxx) </label>
            </div>
        </div>
        <div class="col">
	    <div class="form-floating">
                <select class="form-select" id="dsc_municipio" name="dsc_municipio">
                    <option value="" selected>Selecione o municipio</option>
                    @php($municipios = $registros->unique('dsc_municipio'))
                    @php($municipios = $municipios->sortBy('dsc_municipio'))
                    @foreach($municipios as $registro)
                        <option>{{ $registro->dsc_municipio}}</option>
                    @endforeach 
                </select>
                <label for="dsc_municipio">Municipio</label>
            </div>
        </div>       
    </div>

    <br>

    <div class="row g-2">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="projetoAtividade" name="cod_atv">
                    <option value="" selected>Selecione o Projeto/Atividade</option>
                    @php($projetos = $registros->unique('cod_atv'))
                    @php($projetos = $projetos->sortBy('cod_atv'))
                    @foreach($projetos as $registro)
                        <option value="{{ $registro->cod_atv  }}"  >{{$registro->cod_atv . ' - ' . $registro->dsc_atv}}</option>
                    @endforeach
                </select>
                <label for="projetoAtividade">Projeto/Atividade</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="upg" name="cod_upg">
                    <option value="" selected>Selecione a UPG</option>
                    @php($upgs = $registros->unique('cod_upg'))
                    @php($upgs = $upgs->sortBy('cod_upg'))
                    @foreach($upgs as $registro)
                        @if($registro->cod_upg != 0)
                            <option value="{{ $registro->cod_upg  }}"  >{{$registro->cod_upg . ' - ' . $registro->dsc_upg}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="upg">Unidade de Programação de Gasto</label>
            </div>
        </div>
    </div>

    <br> 

    <div class="row g-3">
    <div class="col">
            <div class="form-floating">
                <input class="form-control" id="cnpj" name="id_credor" placeholder="Digite o CNPJ">
                <label for="cnpj">Digite o CNPJ (somente números)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="credor" name="credor" placeholder="Digite a Razão Social">
                <label for="credor">Razão Social (sem acentuação)</label>
            </div>
        </div>
	<div class="col">
		<div class="form-floating">
			<input class="form-control" id="conta" name="conta" placeholder="Digite o número da conta">
			<label for="conta">Conta Corrente (sem pontuação)</label>
		</div>
	</div>
    </div>

    <br> 

    <input class="btn btn-success" type="submit" value="Consultar">

</form>
@endif

{{-- Formulário de Resposta da Pesquisa --}}
@if(isset($consulta))
@if(empty($consulta)) <script>alert('A consulta não retornou dado!')</script> @endif

<hr>

<table id="table" class="table table-striped" style="width: 100%;">
    <thead class="table-primary">
        <tr>
            @if(isset($consulta[0]['ano_empenho']))<th scope="col">Ano Empenho</th>@endif
	    <th scope="col">Município</th>
            <th scope="col">Cód. Projeto/<br>Atividade</th>
	    <th scope="col">Projeto/<br>Atividade</th>
	    <th scope="col">Cód. Fonte</th>
	    <th scope="col">Cód. UPG</th>
	    <th scope="col">UPG</th>	    
	    <th scope="col">Nº de Empenho</th>
	    <th scope="col">Nº de Documento de Pagamento</th>
	    <th scope="col">Data de Pagamento</th>
	    @if(isset($consulta[0]['ano_empenho']))<th scope="col">Valor Pago Não Processado</th>@endif
	    @if(isset($consulta[0]['ano_empenho']))<th scope="col">Valor Pago Processado</th>@else<th scope="col">Valor Pago Financeiro</th>@endif
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
            @if(isset($registro['ano_empenho']))<td>{{ $registro['ano_empenho'] }}</td>@endif
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
	    @if(isset($registro['ano_empenho']))<td>{{ 'R$ ' . number_format($registro['valor_pago_nproces'], $decimals=2, $dec_pont=',', $thousand_sep='.') }}</td>@endif
	    @if(isset($registro['ano_empenho']))
		<td>{{ 'R$ ' . number_format($registro['valor_pago_proces'], $decimals=2, $dec_point=',', $thousand_sep='.') }}</td>
	    @else 
		<td>{{ 'R$ ' . number_format( $registro['valor_pago_financeiro'], $decimals=2, $dec_pont=',', $thousand_sep='.') }}</td> 
	    @endif
	    <td>{{ $registro['cod_banco'] }}</td>
	    <td>{{ $registro['cod_agencia'] }}</td>
	    <td>{{ $registro['conta'] }}</td>
	    <td>{{ $registro['dsc_sit_pagamento'] }}</td>
	    <td>{{ $registro['id_credor'] }} </td>
            <td>{{ $registro['credor'] }}</td>
	    <td>{{ $registro['ref_contrato_saida'] }}</td>
	    @php($tipo_consulta = $tabela_consulta) 
            <td><a href="{{ route('guest.show', ['tipo_consulta' => $tabela, 'id' => $registro['id']]) }}" class="btn btn-primary">Visualizar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(isset($onsulta[0]['ano_empenho']))
    @php($id_tipo_consulta = 1)
@else
    @php($id_tipo_consulta = 2)
@endif

<input type="hidden" id="id_tipo_consulta" name="id_tipo_consulta" value="{{ $id_tipo_consulta }}"> 

@endif


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
	    {"visible": false, "targets": [4, 5, 6, 7, 8, 12, 13, 14, 15]}
	]
    });

    //mascara para cnpj
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('#numeroResolucao').mask('0000/0000', {reverse: true});
} );
</script>



@endsection


