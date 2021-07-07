@extends('layouts.main')

@section('title', 'PagRes')

@php($registros = DB::table($table)->get())

@section('content')
<h3>Painel de Administrador</h3>


<hr>

{{-- Upload de Planilhas --}}

<div class="card text-center">
    <div class="card-header">
        Carregar Planilha
    </div>
    <div class="card-body">
        <p class="card-text">Importar planilha para o sistema. </p> 
        <p class="card-text"><strong> A planlha deve seguir o mesmo formato da disponibilizada na aba <i>Exportações</i> </strong></p>
            
        <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
            @csrf            
            <div class="form-group">
                <input type="file" name="file" />
                
                <button type="submit" class="btn btn-primary">Carregar</button>
            </div>
        </form>
    </div>
</div>

<hr>

@if($table == 'restos_pagars')
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Pagamentos Restos a Pagar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tablePO') }}">Pagamentos Orçamentários</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <table id="table" class="table">
        <thead>
          <tr>
              <th scope="col">Ano de Origem do Empenho</th>
              <th scope="col">Dotação Orçamentária Resumida </th>
              <th scope="col">Nº de Empenho</th>
              <th scope="col">Valor Pago Processado</th>
              <th scope="col">Informação Bancária</th>
          </tr>
        </thead>
        <tbody>
          @foreach($registros as $registro)
            <tr>  
              <td>{{ $registro->ano_empenho }}</td>
              <td>
                {{ $registro->cod_ue }}.
                {{ $registro->cod_atv }}.
                {{ $registro->cod_fonte }}.
                {{ $registro->cod_procedec }} 
              </td>
              <td>{{ $registro->num_empenho }}</td>
              <td>{{ $registro->valor_pago_proces }}</td>
              <td>
                {{ $registro->cod_banco }}.
                {{ $registro->cod_agencia }}.
                {{ $registro->conta }}.
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@else
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.index') }}">Pagamentos Restos a Pagar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.tablePO') }}">Pagamentos Orçamentários</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <table id="table" class="table">
        <thead>
          <tr>
              <th scope="col">Ano de Pagamento</th>
              <th scope="col">Dotação Orçamentária Resumida </th>
              <th scope="col">Nº do Documento de Pagamento</th>
              <th scope="col">Valor Pago Financeiro</th>
              <th scope="col">Informação Bancária</th>
          </tr>
        </thead>
        <tbody>
          @foreach($registros as $registro)
            <tr>  
              <td>{{ substr($registro->data_pgto, 0, 4) }}</td>
              <td>
                {{ $registro->cod_ue }}.
                {{ $registro->cod_atv }}.
                {{ $registro->cod_fonte }}.
                {{ $registro->cod_procedec }} 
              </td>
              <td>{{ $registro->num_dcto_pgto }}</td>
              <td>{{ $registro->valor_pago_financeiro }}</td>
              <td>
                {{ $registro->cod_banco }}.
                {{ $registro->cod_agencia }}.
                {{ $registro->conta }}.
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endif

@endsection

