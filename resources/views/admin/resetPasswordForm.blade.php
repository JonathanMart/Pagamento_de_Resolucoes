@extends('layouts.main')

@section('title', 'Pagamento de Resoluções - Redefinir Senha')

@section('content')
<h3>Redefinição de Senha</h3>
<hr>

<br>

<form action="{{ route('register') }}" method="post">
    @csrf

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
                <label for="email">Senha</label>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input class="form-control" type="password" id="password" name="password_confirmation" placeholder="Digite a senha do usuário">
                <label for="email">Confirme a senha</label>
            </div>
        </div>
    </div>

    <input type="hidden" id="token" name="_token" value="{{ $token }}">

    <input class="btn btn-success" type="submit" value="Redefinir">

</form>


@endsection