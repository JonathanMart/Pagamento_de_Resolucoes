@extends('layouts.main')

@section('title', 'Pagamento de Resoluções - Usuários')

@php($usuarios = DB::table('users')->get())

@section('content')
<h3>Usuários</h3>
<hr>

<table id="table" class="table table-striped" style="width:100%">
    <thead class="table-primary">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Usuário</th>
            <th scope="col">E-mail</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>  
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
                <form action="{{ route('user.delete', ['id' => $usuario->id]) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button class="btn btn-danger" title="Deletar" onclick="return confirm('Deseja realmente excluir o usuario?');">Deletar</button>        
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br> 

<a href="{{ route('register') }}" class="btn btn-success">Adicionar Usuário</a>

<br>

@endsection

