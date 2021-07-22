@extends('layouts.login')

@section('title', 'Pagamento de Resoluções - Redefinir Senha')

@section('content')
<main class="login-form">
    <div class="card"id="telaLogin">
        <img src="{{ url('img/logo3.png') }}" class="card-img-top" alt="Logo">
        @if(isset($success_message))
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <p class="card-text">{{$success_message}}</p>
                </div>
             </div>
        @elseif(isset($danger_message))
           <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <p class="card-text">{{$danger_message}}</p>
                </div>
             </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('sendEmail') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="nome@email.com">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="d-grid ">
                    <button type="submit" class="btn btn-outline-success btn-block">Redefinir Senha</button>
                </div>
            </form>  
        </div>
    </div>
</main>
@endsection

