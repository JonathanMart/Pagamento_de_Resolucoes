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
    <body style="background-color: #F6F6F8">
        {{-- Header da Página --}}
        <header class="bg-dark" style="color:#F6F6F8;">
        </header>
    
        {{-- Navbar --}}
        <nav class="navbar navbar-light" style="background-color: #212529">
            <div class="container" id="center">
                <div class="row" style="color:#F6F6F8; height: 90px;">
                    <div class="col" onclick=" homepage() ">
                        <p id="logo-text">Pagamento de Resoluções</p> 
                        <p id="logo-text-ses"><strong>SES/MG</strong></p>
                    </div>
                </div>
                <div class="left">
                    <span class="text-white">{{ auth()->user()->name ?? " " }}</span>
                </div>
                <div class="right">
                    @if(!auth()->check())
                        <a href="{{ route('admin.index') }}"><i class="fas fa-user-lock fa-3x text-white"></i></a>
                    @else
                        <a href="{{ route('logout') }}"><i class="fas fa-user-slash fa-3x" style="color:darkred;"></i></a>
                    @endif
                </div>
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
