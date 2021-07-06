@extends('layouts.main')

@section('title', 'PagRes - Login')

@section('content')
<form method="post" action="{{ route('admin.loginForm') }}">
    @csrf
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="usuario@example.com">
        <label for="floatingInput">Usuário</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="senha" name="password" placeholder="Password">
        <label for="floatingPassword">Senha</label>
    </div>
    <input class="btn btn-primary" type="submit" value="Submit">
</form>


@endsection

