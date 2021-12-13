<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
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

        {{-- CSS de Acessibilidade --}}
        <link rel="stylesheet" href="{{ url('assets/css/acessibilidade.css') }}">

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
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="#" id="altocontraste" ccesskey="1" onclick="window.toggleContrast()" onkeydown="window.toggleContrast()">CONTRASTE</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="https://www.saude.mg.gov.br/transparencia" accesskey="2">TRANSPARÊNCIA</a></li>
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="{{ route('perguntas-frequentes') }}" accesskey="3">Perguntas Frequentes</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="{{ route('contatos') }}" accesskey="4">CONTATO</a></li>
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="{{ route('utilizacao-pagamento-resolucoes') }}" accesskey="5">UTILIZAÇÃO DO PAGAMENTO DE RESOLUÇÕES</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="{{ route('outros-sistemas') }}" accesskey="6">OUTROS SISTEMAS</a></li> 
                            <li class="nav-item font-nav-bar"> <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}" accesskey="7">ACESSO DO ADMINISTRADOR</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        {{-- NavBar de Logo e Busca --}}
        <nav class="navbar navbar-light">
            <div class="container">
                <a class="navbar-brand" href="https://www.saude.mg.gov.br/">
                    <img src="{{ url('img/logo-secretaria-de-saude-mg-pequena.png') }}" alt="Secretaria de Estado de Saúde" class="d-inline-block align-text-top">
                </a>
                <div class="col" id="center" onclick="homepage()">
                    <div class="row">
                        <p id="logo-text">Pagamento de</p></span>
                    </div>
                    <div class="row">
                        <p id="logo-text-ses"><strong>Resoluções</strong></p></span>
                    </div>   
                </div>
            </div>
        </nav>

        <hr>

        {{-- Menu Principal --}}
        <nav class="navbar-collapse navbar-expand-sm navbar-light sombreado">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if($_SERVER["REQUEST_URI"] == '/')
                        <li class="nav-item"> <button type="button" class="btn btn-danger">Página Inicial</button></li>
                    @else
                        <li class="nav-item"> <a class="nav-link active teste" aria-current="page" href="{{ route('guest.index') }}">Página Inicial</a></li>
                    @endif

                    @if($_SERVER["REQUEST_URI"] == '/pagamentos-orcamentarios')
                        <li class="nav-item"> <button type="button" class="btn btn-danger">Pagamentos Orçamentários</button></li> 
                    @else
                        <li class="nav-item"> <a class="nav-link active" aria-current="page" href="{{ route('pagamentos-orcamentarios.index') }}">Pagamentos Orçamentarios</a></li> 
                    @endif

                    @if($_SERVER["REQUEST_URI"] == '/restos-a-pagar')
                        <li class="nav-item">  <button type="button" class="btn btn-danger">Pagamentos de Restos a Pagar</button></li>                    
                    @else
                        <li class="nav-item"> <a class="nav-link active" aria-current="page" href="{{ route('restos-a-pagar.index') }}">Pagamento de Restos a Pagar</a></li>                    
                    @endif

                   
                    @if(isset(Auth::user()->id)) 
                        <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">Painel de Administrador</a></li>
                        <li class="nav-item"> 
                            <a class="nav-link active" aria-current="page" href="{{ route('logout') }}">
                                <span style="color:red;"><strong>LOGOUT</strong></span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <br>

        <div class="container">
            @yield('content')
            <br>
        </div>

        <hr>

        <div class="footer-clean">
            <footer>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 col-md-3 item">
                            <h3>Outros Sistemas</h3>
                            <ul>
                                <li><a href="http://sig-res.saude.mg.gov.br/">SIGRES</a></li>
                                <li><a href="http://declarasus.saude.mg.gov.br/">DeclaraSUS</a></li>
                                <li><a href="https://dados.mg.gov.br/dataset/doacoes-covid-19">Doações Coronavírus</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-3 item">
                            <h3>Fale Conosco</h3>
                            <ul>
                                <li><a href="mailto:spf@saude.mg.gov.br">Superintendência de Planejamento e Finanças</a></li>
                                <li><a href="mailto:dfcr@saude.mg.gov.br">Diretoria de Formalização de Convênios e Resoluções</a></li>
                                <li><a href="mailto:william.silva@saude.mg.gov.br">Diretoria de Inovação e Tecnologia da Informação</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-3 item">
                            <h3>Lei de Acesso à Informação</h3>
                            <ul>
                                <li><a href="http://www.acessoainformacao.mg.gov.br/sistema/site/index.html?ReturnUrl=%2fsistema%2f">e-SIC</a></li>
                                <li><a href="https://www.ouvidoriageral.mg.gov.br/canais-atendimento">Ouvidoria</a></li>
                                <li><a href="#">LGPD</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 item social"><a href="https://www.facebook.com/SaudeMG"><i class="fab fa-facebook"></i></a><a href="https://twitter.com/saudemg"><i class="fab fa-twitter"></i></a><a href="https://www.youtube.com/user/saudemg"><i class="fab fa-youtube"></i></a><a href="https://www.instagram.com/saudemg/"><i class="fab fa-instagram"></i></a>
                            <p class="copyright">{{'©' . date('Y') }} <strong>Secretaria de Estado de Saúde</strong></p>
                            <p class="copyright">Desenvolvido por <strong>Diretoria de Inovação e Tecnologia da Informação</strong></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function homepage(){
                window.location.href = "http://pagamentoderesolucoes.saude.mg.gov.br//";
            }

            (function () {
                var Contrast = {
                    storage: 'contrastState',
                    cssClass: 'contrast',
                    currentState: null,
                    check: checkContrast,
                    getState: getContrastState,
                    setState: setContrastState,
                    toogle: toogleContrast,
                    updateView: updateViewContrast
                };

                window.toggleContrast = function () { Contrast.toogle(); };

                Contrast.check();

                function checkContrast() {
                    this.updateView();
                }

                function getContrastState() {
                    return localStorage.getItem(this.storage) === 'true';
                }

                function setContrastState(state) {
                    localStorage.setItem(this.storage, '' + state);
                    this.currentState = state;
                    this.updateView();
                }

                function updateViewContrast() {
                    var body = document.body;
                    
                    if (!body) return;

                    if (this.currentState === null)
                        this.currentState = this.getState();

                    if (this.currentState)
                        body.classList.add(this.cssClass);
                    else
                        body.classList.remove(this.cssClass);
                }

                function toogleContrast() {
                    this.setState(!this.currentState);
                }
            })();
        </script>

    </body>

</html>
