<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial scale=1">
        
        
        <title>@yield('title')</title>

        {{-- CSS da Aplicação --}}
        <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
        
        {{-- CSS do Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        {{-- Fontes do Google --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        {{-- Javascript --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
        <script type="text/javascript" src="{{ url ('assets/js/javascript.js') }}"></script>
        
        
    </head>
    <body style="background-color: #F6F6F8">
        {{-- Header da Página --}}
        <header class="bg-dark">
            Acesso de Administrador
        </header>
    
        {{-- Navbar --}}
        <nav class="navbar navbar-light" style="background-color: #F6F6F8">
            <div class="container">
                <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar informações" aria-label="">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
                    </div>
                </form>
            </div>        
        </nav>
        <br>
        
        <div class="container">
            @yield('content')
        </div>
        
       <!--  <footer>
            <p>Secretaria de Saude</p>
        </footer> -->

    </body>

</html>