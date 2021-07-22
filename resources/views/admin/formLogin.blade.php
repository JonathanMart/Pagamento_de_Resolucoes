@extends('layouts.login')

@section('title', 'Pagamento de Resoluções - Login')

@section('content')
<main class="login-form">
    <div class="card"id="telaLogin">
        <img src="{{ url('img/logo3.png') }}" class="card-img-top" alt="Logo">
        <div class="card-body">
            <form method="POST" action="{{ route('auth') }}">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="nome@email.com">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                    <label for="floatingPassword">Senha</label>
                </div>
                <div class="form-check form-switch">
                    <input name="remember" class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Lembrar de mim</label>
                </div>
                <br>
                <div class="d-grid ">
                    <button type="submit" class="btn btn-outline-primary btn-block">Entrar</button>
                </div>
            </form>  

            <div class="d-grid" style="margin-top: 5px;">
                <a href="{{ route('resetPasswordEmail') }}" class="btn btn-outline-danger btn-block">Esqueci Minha Senha</a>
            </div>
        </div>
    </div>
</main>
@endsection

