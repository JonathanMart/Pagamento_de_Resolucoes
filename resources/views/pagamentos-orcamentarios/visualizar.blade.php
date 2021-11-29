@extends('layouts.main')

@section('title', 'Pagamento de Resoluções - Visualizar Pagamentos Orçamentários')

@section('content')
<h3>Visualizar </h3>
<hr>

<div class="row g-2">
    <div class="col">
        <label for="ue" class="form-label">Unidade Executora (UE)</label>
        <input class="form-control" id="ue" type="text" value="{{ $cod_ue . ' - ' . $nome_ue }}" disabled readonly>
    </div>
    <div class="col">
        <label for="ref_contrato_entrada" class="form-label">Nº de Referência do Contrato/Convênio de Entrada</label>
        <input class="form-control" id="ref_contrato_entrada" type="text" value="{{ $ref_contrato ?? 'N/D'}}" disabled readonly>
    </div>
</div>
<br>
<div class="row g-2">
    <div class="col-8">
        <label for="atv" class="form-label">Atividade/Projeto</label>
        <input class="form-control" id="atv" type="text" value="{{ $cod_atv .' - '. $dsc_atv }}" disabled readonly>
    </div>
    <div class="col">
        <label for="fonte" class="form-label">Fonte</label>
        <input class="form-control" id="fonte" type="text" value="{{ $cod_fonte }}" disabled readonly>
    </div>
</div>
<br>
<div class="row g-2">
    <div class="col">
        <label for="ref_contrado_saida" class="form-label">Nº de Referência do Contrato/Convênio de Saída</label>
        <input class="form-control" id="ref_contrado_saida" type="text" value="{{ $ref_contrato_saida }}" disabled readonly>
    </div>
    <div class="col-8">
        <label for="cod_upg" class="form-label">Unidade de Programação de Gasto</label>
        <input class="form-control" id="cod_upg" type="text" value="{{ $cod_upg . ' - ' . $dsc_upg }}" disabled readonly>
    </div>
</div>
<br>
<div class="row g-3">
    <div class="col">
        <label for="id_credor" class="form-label">CNPJ/CPF do Credor</label>
        <input class="form-control" id="id_credor" type="text" value="{{ $id_credor }}" disabled readonly>
    </div>
    <div class="col">
        <label for="credor" class="form-label">Razão Social do Credor</label>
        <input class="form-control" id="credor" type="text" value="{{ $credor }}" disabled readonly>
    </div>
    <div class="col">
        <label for="ref_contrado_saida" class="form-label">Nº de Referência do Contrato/Convênio de Saída</label>
        <input class="form-control" id="ref_contrado_saida" type="text" value="{{ $ref_contrato_saida }}" disabled readonly>
    </div>
</div>
<br>
<div class="row g-5">
    <div class="col">
        <label for="num_empenho" class="form-label">Nº do Empenho</label>
        <input class="form-control" id="num_empenho" type="text" value="{{ $num_empenho }}" disabled readonly>
    </div>
    <div class="col">
        <label for="num_ordem_pgto" class="form-label">Nº Documento Pagamento</label>
        <input class="form-control" id="num_ordem_pgto" type="text" value="{{ $num_dcto_pgto }}" disabled readonly>
    </div>
    <div class="col">
        <label for="valor_pago_financeiro" class="form-label">Valor Pago Financeiro</label>
        <input class="form-control" id="valor_pago_financeiro" type="text" value="{{ $valor_pago_financeiro  }}" disabled readonly>
    </div>    
</div>
<br>
<div class="row g-5">
    <div class="col">
        <label for="data_pgto" class="form-label">Data do Pagamento</label>
        <input class="form-control" id="data_pgto" type="text" value="{{ substr($data_pgto, -2, 2).'/'.substr($data_pgto, 5, 2).'/'.substr($data_pgto, 0, 4) }}" 
        disabled readonly>
    </div>
    <div class="col">
        <label for="cod_banco" class="form-label">Banco</label>
        <input class="form-control" id="cod_banco" type="text" value="{{ $cod_banco }}" disabled readonly>
    </div>
    <div class="col">
        <label for="cod_agencia" class="form-label">Agência</label>
        <input class="form-control" id="cod_agencia" type="text" value="{{ $cod_agencia }}" disabled readonly>
    </div>
    <div class="col">
        <label for="conta" class="form-label">Conta</label>
        <input class="form-control" id="conta" type="text" value="{{ $conta }}" disabled readonly>
    </div>
    <div class="col">
        <label for="dsc_sit_pgto" class="form-label">Situação do Pagamento</label>
        <input class="form-control" id="dsc_sit_pgto" type="text" value="{{ $dsc_sit_pgto }}" disabled readonly>
    </div>
</div>
<br>
<div class="row g-1">
    <div class="col">
        <label for="dsc_municipio" class="form-label">Município</label>
        <input class="form-control" id="dsc_municipio" type="text" value="{{ $dsc_municipio }}" disabled readonly>
    </div>
</div>

<br>

<button type="button" class="btn btn-primary" onclick="history.go(-1)"><i class="fas fa-backward"></i>{{ ' '. 'Voltar' }}</button>

<br>

@endsection


