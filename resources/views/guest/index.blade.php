@extends('layouts.main')

@section('title', 'Pagamento de Resoluções')

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
                    @php($anos_pagamento=array())
                    @php($datas_pagamento = DB::table('restos_pagars')->pluck('data_pgto'))
                    @foreach($datas_pagamento as $data)
                        @php($anos_pagamento[]=substr($data, 0, 4)) 
                    @endforeach
                    @php($anos = array_unique($anos_pagamento))
                    @foreach($anos as $ano)
                        <option>{{ $ano }}</option>
                    @endforeach
                </select>
                <label for="ano">Ano do Pagamento</label>
            </div>
        </div>
    </div>

    <br>
    
    <div class="row g-3">
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="numeroResolucao" name="num_empenho" placeholder="Digite o Nº da Resolução">
                <label for="numeroResolucao">Nº da Resolução</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ue" name="cod_ue">
                    <option value="" selected>Selecione a Unidade Executora</option>
                    @php($unidades_executoras = $registros->unique('nome_ue'))
                    @php($unidades_executoras = $unidades_executoras->sortBy('nome_ue'))
                    @foreach($unidades_executoras as $registro)
                        <option>{{ $registro->cod_ue . ' - ' . $registro->nome_ue}}</option>
                    @endforeach 
                </select>
                <label for="ue">Unidade Executora</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="municipio" name="municipio" placeholder="Digite o Município">
                <label for="municipio">Município</label>
            </div>
        </div>
    </div>

    <br>

    <div class="row g-2">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="projetoAtividade" name="dsc_atv">
                    <option value="" selected>Selecione o Projeto/Atividade</option>
                    @php($projetos = $registros->unique('cod_atv'))
                    @php($projetos = $projetos->sortBy('cod_atv'))
                    @foreach($projetos as $registro)
                        <option>{{$registro->cod_atv . ' - ' . $registro->dsc_atv}}</option>
                    @endforeach
                </select>
                <label for="projetoAtividade">Projeto/Atividade</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="upg" name="dsc_upg">
                    <option value="" selected>Selecione a UPG</option>
                    @php($upgs = $registros->unique('cod_upg'))
                    @php($upgs = $upgs->sortBy('cod_upg'))
                    @foreach($upgs as $registro)
                        @if($registro->cod_upg != 0)
                            <option>{{$registro->cod_upg . ' - ' . $registro->dsc_upg}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="upg">Unidade de Programação de Gasto</label>
            </div>
        </div>
    </div>

    <br> 

    <div class="row g-2">
    <div class="col">
            <div class="form-floating">
                <input class="form-control" id="cnpj" name="id_credor" placeholder="Digite o CNPJ">
                <label for="cnpj">Digite o CNPJ (somente números)</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="razaoSocial" name="razaoSocial" placeholder="Digite a Razão Social">
                <label for="razaoSocial">Razão Social</label>
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

<table id="table" class="table table-striped" style="width:100%">
    <thead class="table-primary">
        <tr>
            @if(isset($consulta[0]['ano_empenho']))<th scope="col">Ano Empenho</th>@endif
            <th scope="col">Unidade Executora</th>
            <th scope="col">Municipio</th>
            <th scope="col">Projeto/Atividade</th>
            <th scope="col">UPG</th>
            <th scope="col">Razão Social</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($consulta as $registro)
        <tr>  
            @if(isset($registro['ano_empenho']))<td>{{ $registro['ano_empenho'] }}</td>@endif
            <td>{{ $registro['nome_ue'] }}</td>
            <td>{{ $registro['dsc_municipio'] }}</td>
            <td>{{ $registro['dsc_atv'] }}</td>
            <td>{{ $registro['dsc_upg'] ?? 'N/D' }} </td> 
            <td>{{ $registro['credor'] }}</td>
            <td><a href="{{ route('guest.show', ['id' => $registro['id']]) }}" class="btn btn-primary">Visualizar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif


{{-- Javascript para datatable e Mask --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
$(document).ready(function() {
    //DataTable
    $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel',
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });

    //mascara para cnpj
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});

} );
</script>



@endsection


