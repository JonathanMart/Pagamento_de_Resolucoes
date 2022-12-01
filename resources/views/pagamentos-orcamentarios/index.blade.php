@extends('layouts.main')

@section('title', 'Pagamento de Resoluções: Pagamentos Orçamentários')
@section('content')
<h3>Pagamentos Orçamentários</h3>
<hr>

{{-- Formulario de Pesquisa --}}

<div class="alert alert-success">
    <ul>
	<li>O campo Ano do Pagamento é obrigatório</li> 
	<li>O campo Municipio é obrigatório</li>
    </ul>	
</div>


@if($errors->any())
<div class="alert alert-danger"> 
    <ul>
	@foreach($errors->all() as $error)
	    <li>{{ $error }}</li>
	@endforeach
    </ul>
</div>
@endif

<form action="{{ route('pagamentos-orcamentarios.search') }}" method="post">
    @csrf

    <div class="row g-3">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ano_pagamento" name="data_pgto">
                    <option value="" selected>Selecione o ano de Pagamento</option>
                    @foreach($anos_pagamento as $ano)
                        <option>{{ $ano }}</option>
                    @endforeach
                </select>
                <label for="ano">Ano do Pagamento</label>
            </div>
        </div>
        <div class="col">
	        <div class="form-floating">
                <select class="form-select" id="dsc_municipio" name="dsc_municipio">
                    <option value="" selected>Selecione o municipio</option>
                    @foreach($municipios as $municipio)
                        <option>{{ $municipio}}</option>
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
                <input class="form-control" id="numeroResolucao" name="ref_contrato_saida" placeholder="Digite o Nº da Resolução">
                <label for="numeroResolucao">Digite o Nº da Resolução (no formato xxxx/xxxx) </label>
            </div>
        </div>
       
    </div>

    <br>

    <div class="row g-2">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="projetoAtividade" name="cod_atv">
                    <option value="" selected>Selecione o Projeto/Atividade</option>
                    @foreach($projetos_atividades as $cod_projeto_atividade => $projeto_atividade)
                        <option value="{{ $cod_projeto_atividade }}">{{$cod_projeto_atividade . ' - ' . $projeto_atividade}}</option>
                    @endforeach
                </select>
                <label for="projetoAtividade">Projeto/Atividade</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="upg" name="cod_upg">
                    <option value="" selected>Selecione a UPG</option>
                    @foreach($upg as $cod_upg => $upg)
                        <option value="{{ $cod_upg  }}"  >{{$cod_upg . ' - ' . $upg}}</option>
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

<br>

<a href="{{ route('guest.index') }}"><button class="btn btn-primary" type="submit"><i class="fas fa-home"></i>{{ ' '. 'Página Inicial'}}</button></a>

{{-- Javascript para datatable e Mask --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
$(document).ready(function() {
    //mascara para cnpj
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    //mascara para numero de resolucao 
    $('#numeroResolucao').mask('0000/0000', {reverse: true});
} );
</script>



@endsection


