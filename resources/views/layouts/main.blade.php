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
        
        {{-- CSS do Datatable --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

        {{-- Fontes do Google --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        {{-- Javascript --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
        <script type="text/javascript" src="{{ url ('assets/js/javascript.js') }}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


	{{--Colums Visibility--}}
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>	


        <script src="https://kit.fontawesome.com/cabf0d962e.js" crossorigin="anonymous"></script>

           
    </head>
    <body style="background-color: #FFF">
        {{-- Header da Página --}}
        <header class="bg-dark" style="color:#F6F6F8;">
            <nav class="navbar-collapse navbar-expand-sm navbar-dark bg-dark">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">CONTRASTE</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">TRANSPARÊNCIA</a></li>
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">ACESSIBILIDADE</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">MAPA DA APLICAÇÃO</a></li>
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">UTILIZAÇÃO DO PAGAMENTO DE RESOLUÇÕES</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">OUTROS SISTEMAS</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#">ACESSO DO ADMINISTRADOR</a></li> 
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        {{-- NavBar de Logo e Busca --}}
        <nav class="navbar navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ url('img/logo-secretaria-de-saude-mg-pequena.png') }}" alt="Secretaria de Estado de Saúde" class="d-inline-block align-text-top">
                </a>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Buscar">
                    <button class="btn btn-outline-danger" type="submit">Busca</button>
                </form>
            </div>
        </nav>

        <hr>

        {{-- Menu Principal --}}
        <nav class="navbar-collapse navbar-expand-sm navbar-light sombreado">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">Pagamentos Orçamentarios</a></li> 
                    <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">Restos a Pagar</a></li>
                </ul>
            </div>
        </nav>

        <br>

        <div class="container">
            @yield('content')
            <br>
        </div>

        <script>
            function homepage(){
                window.location.href = "http://pagamentoderesolucoes.saude.mg.gov.br//";
            }
        </script>

    </body>

</html>
