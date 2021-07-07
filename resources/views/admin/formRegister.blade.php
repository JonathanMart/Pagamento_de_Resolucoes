@extends('layouts.main')

@section('title', 'PagRes - Registro de Usuário')

@section('content')
<h3>Cadastrar Usuário</h3>
<hr>

<br>

<form action="{{ route('register') }}" method="post">
    @csrf

    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="name" name="name" placeholder="Digite o Nome do Usuário">
                <label for="name">Nome do Usuário</label>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input class="form-control" id="email" name="email" placeholder="Digite o email do usuário">
                <label for="email">Email do Usuário</label>
            </div>
        </div>
    </div>
    <br>    
    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input class="form-control" type="password" id="password" name="password" placeholder="Digite a senha do usuário">
                <label for="email">Senha do Usuário</label>
            </div>
        </div>
    </div>
    <br>
    <input class="btn btn-success" type="submit" value="Cadastrar">

</form>


@endsection


