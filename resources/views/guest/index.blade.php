@extends('layouts.main')

@section('title', 'PagRes')

@section('content')
<h3>Pagamento de Resoluções</h3>
<hr>

{{-- Card de informação --}}
<div class="card text-white bg-info mb-3">
  <div class="card-header">Instruções</div>
  <div class="card-body">
    <p class="card-text">Os campos com <strong style="color: red;">*</strong> são de preenchimento obrigatório</p>
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
                <select class="form-select" id="municipio" name="dsc_municipio">
                    <option value="" selected>Selecione o Município</option>
                    @php($municipios = $registros->unique('dsc_municipio'))
                    @php($municipios = $municipios->sortBy('dsc_municipio'))
                    @foreach($municipios as $registro)
                        <option>{{$registro->dsc_municipio}}</option>
                    @endforeach
                </select>
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
                <select class="form-select" id="cnpj" name="cnpj">
                    <option value="" selected>Selecione o CNPJ do Credor</option>
                    @php($ids_credor = $registros->unique('id_credor'))
                    @php($ids_credor = $ids_credor->sortBy('id_credor'))
                    @foreach($ids_credor as $registro)
                        <option>{{$registro->id_credor}}</option>
                    @endforeach
                </select>
                <label for="cnpj">CNPJ do Credor</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="razaoSocial" name="razaoSocial">
                    <option value="" selected>Selecione a Razão Social do Credor</option>
                    @php($razoes_sociais = $registros->unique('credor'))
                    @php($razoes_sociais = $razoes_sociais->sortBy('credor'))
                    @foreach($razoes_sociais as $registro)
                        <option>{{$registro->credor}}</option>
                    @endforeach
                </select>
                <label for="cnpj">Razão Social do Credor</label>
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

<table id="table" class="table align-middle">
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


<br>

@endif


{{-- Javascript para select dinâmico --}}



@endsection


