@extends('layouts.main')

@section('title', 'PagRes')

@php($registros = DB::table('restos_pagars')->get())

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
        <a href="{{ route('guest.tipoConsulta', ['tipo' => '2']) }}" class="btn btn-primary">Pagamentos Orçamentários</a>
    </div>
</div>

<br>

@if(isset($tipoConsulta))
{{-- Formulario de Pesquisa --}}
<form action="{{ route('guest.search') }}", method="post">
    @csrf

    <div class="row g-4">
        <div class="col">
            <div class="form-floating">
                <select data-url="{{ url('consulta') }}" data-token="{{ csrf_token() }}" 
                onchange="changetipoConsulta(this)" class="form-select" id="tipoConsulta" name="tipo_consulta">
                    <option value="" selected>Selecione o tipo de consulta</option>
                    <option value="restos_pagar">Pagamentos de Restos a Pagar</option>
                    <option value="pagamentos_orcamentarios">Pagamentos Orçamentários</option>
                </select>
                <label for="tipoConsulta">Tipo de Consulta <strong style="color: red;">*</strong></label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ano" name="ano_empenho">
                    <option value="" selected>Selecione o ano</option>
                    @foreach($registros as $registro)
                        <option>{{$registro->ano_empenho}}</option>
                    @endforeach
                </select>
                <label for="ano">Ano do Empenho<strong style="color: red;"> *</strong></label>
            </div>
        </div>     
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="dataInicio" name="data_inicio" placeholder="Digite a data inicial">
                <label for="dataInicio">Data Inicial</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="dataFim" name="data_fim" placeholder="Digite a data final">
                <label for="dataFim">Data Final</label>
            </div>
        </div>
    </div>
    <br>
    <div class="row g-4">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="agencia" name="cod_agencia">
                    <option value="" selected>Selecione a Agência</option>
                    @foreach($registros as $registro)
                        <option>{{$registro->cod_agencia}}</option>
                    @endforeach
                </select>
                <label for="agencia">Agência</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="banco" name="cod_banco">
                    <option value="" selected>Selecione o Banco</option>
                    @foreach($registros as $registro)
                        <option>{{$registro->cod_banco}}</option>
                    @endforeach                
                </select>
                <label for="banco">Banco</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="conta" name="conta">
                    <option value="" selected>Selecione a Conta</option>
                    @foreach($registros as $registro)
                        <option>{{$registro->conta}}</option>
                    @endforeach 
                </select>
                <label for="conta">Conta</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="numeroResolucao" name="num_empenho" placeholder="Digite o Nº da Resolução">
                <label for="numeroResolucao">Nº da Resolução</label>
            </div>
        </div>
    </div>
    <br>
    <div class="row g-4">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ue" name="cod_ue">
                    <option value="" selected>Selecione a Unidade Executora</option>
                    <option>PHP</option>
                    @foreach($registros as $registro)
                        <option value="{{$registro->cod_ue}}">{{$registro->nome_ue}}</option>
                    @endforeach 
                </select>
                <label for="ue">Unidade Executora</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="municipio" name="dsc_municipio">
                    <option value="" selected>Selecione o Município</option>
                    @foreach($registros as $registro)
                        <option>{{$registro->dsc_municipio}}</option>
                    @endforeach
                </select>
                <label for="municipio">Município</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="projetoAtividade" name="dsc_atv">
                    <option value="" selected>Selecione o Projeto/Atividade</option>
                    <option>PHP</option>
                    <option>PHP</option>
                </select>
                <label for="projetoAtividade">Projeto/Atividade</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="upg" name="dsc_upg">
                    <option value="" selected>Selecione a UPG</option>
                    <option>PHP</option>
                    <option>PHP</option>
                </select>
                <label for="upg">Unidade de Programação de Gasto</label>
            </div>
        </div>
    </div>

    <br>

    <input class="btn btn-success" type="submit" value="Consultar">

</form>

{{-- Formulário de Resposta da Pesquisa --}}
@if(isset($consulta))
<hr>

<table id="table" class="table align-middle">
    <thead class="table-primary">
        <tr>
            <th scope="col">Ano</th>
            <th scope="col">Agência</th>
            <th scope="col">Banco</th>
            <th scope="col">Conta</th>
            <th scope="col">Unidade Executora</th>
            <th scope="col">Municipio</th>
            <th scope="col">Projeto/Atividade</th>
            <th scope="col">UPG</th>
            <th scope="col">Ações</th>

        </tr>
    </thead>
    <tbody>
        @foreach($consulta as $registro)
        <tr>  
            <td>{{ $registro['ano_empenho'] }}</td>
            <td>{{ $registro['cod_agencia'] }}</td>
            <td>{{ $registro['cod_banco'] }}</td>
            <td>{{ $registro['conta'] }}</td>
            <td>{{ $registro['nome_ue'] }}</td>
            <td>{{ $registro['dsc_municipio'] }}</td>
            <td>{{ $registro['dsc_atv'] }}</td>
            <td>{{ $registro['dsc_upg'] ?? 'N/D' }} </td> 
            <td><a href="{{ route('guest.show', ['id' => $registro['id']]) }}" class="btn btn-primary">Visualizar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>


<br>

@endif


{{-- Javascript para select dinâmico --}}



@endsection


