@extends('layouts.main')

@section('title', 'Pagamento de Resoluções')

@section('content')

{{-- Linha de Cards de Informação --}}

<div class="container center">
    <div class="alert alert-primary" role="alert">
        @php($last_id = DB::table('restos_pagars')->orderBy('id', 'desc')->first())
        @php($last_id != null ? $last_id = $last_id->id : null )
        @php($date = DB::table('restos_pagars')->where('id', $last_id)->value('updated_at'))
        @php($ano = substr($date, 0, 4))
        @php($mes = substr($date, 5, 2))
        @php($dia = substr($date, 8, 2))
        @php($hora = substr($date, 11, 8))
        <i class="fas fa-info-circle"></i>
        <strong>Última atualização: {{ $dia }}/{{ $mes }}/{{ $ano }} às {{ $hora }}</strong> 
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-block">
                    <h4 class="card-title">Pagamentos Orçamentarios</h4>
                    <h2><a href="{{ route('pagamentos-orcamentarios.index') }}"><i class="fa fas fa-money-bill-wave-alt fa-3x"></i></a></h2>
                </div>
                <div class="col">
                    <div class="row">
                        <h5 class="card card-block border-0">Valor Total Pago Financeiro {{ date('Y') }}</h5>
                    </div>
                    <div class="row">
                        <h5 class="card card-block border-0">{{ 'R$' . number_format($valor_pago_financeiro, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-block">
                    <h5 class="card-title">Pagamentos de Restos a Pagar</h5>
                    <h2><a href="{{ route('restos-a-pagar.index') }}"><i class="fas fa-dollar-sign fa-3x"></i></a></h2>
                </div>
                <div class="col">
                    <div class="row">
                        <h5 class="card card-block border-0">Valor Total Pago Processado {{ date('Y') }}</h5>
                    </div>
                    <div class="row">
                        <h5 class="card card-block border-0">{{ 'R$' . number_format($valor_pago_processado, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-block">
                    <h5 class="card-title">Pagamentos de Restos a Pagar</h5>
                    <h2><a href="{{ route('restos-a-pagar.index') }}"><i class="fas fa-coins fa-3x"></i></a></h2>
                </div>
                <div class="col">
                    <div class="row">
                        <h5 class="card card-block border-0">Valor Total Pago Não Processado {{ date('Y') }}</h5>
                    </div>
                    <div class="row">
                        <h5 class="card card-block border-0">{{ 'R$' . number_format($valor_pago_nao_processado, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        Este sistema destina-se à apresentação do Pagamento de Resoluções de 2020 e 2021
    </div>
</div>

@endsection

<i class="fal fa-sack-dollar"></i>
