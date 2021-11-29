@extends('layouts.main')

@section('title', 'Pagamento de Resoluções: Restos a Pagar')

@php($restos_a_pagar = DB::table('restos_pagars')->get())

@section('content')
<h3>Pagamentos de Restos a Pagar</h3>
<hr>

{{-- Formulario de Pesquisa --}}
<form action="{{ route('restos-a-pagar.search') }}" method="post">
    @csrf

    <div class="row g-3">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ano_empenho" name="ano_empenho">
                    <option value="" selected>Selecione o ano do Empenho</option>
                    @php($anos_empenho = $restos_a_pagar->unique('ano_empenho'))
                    @php($anos_empenho = $anos_empenho->sortBy('ano_empenho'))
                    @foreach($anos_empenho as $registro)
                        <option>{{$registro->ano_empenho}}</option>
                    @endforeach
                </select>
                <label for="ano">Ano do Empenho<strong style="color: red;"> *</strong></label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="ano_pagamento" name="data_pgto">
                    <option value="" selected>Selecione o ano de Pagamento</option>
                    @php($anos = $restos_a_pagar->unique('data_pgto'))
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
                    @php($municipios = $restos_a_pagar->unique('dsc_municipio'))
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
                    @php($projetos = $restos_a_pagar->unique('cod_atv'))
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
                    @php($upgs = $restos_a_pagar->unique('cod_upg'))
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


