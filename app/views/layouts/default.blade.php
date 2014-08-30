<!doctype html>
<html>
<head>

<title>UFCA - Controle de formulários | @yield('titulo')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{ HTML::style("assets/css/jquery-ui.css") }}
<link href="{{ URL::asset('assets/css/jquery-ui.css') }}" rel="stylesheet" media="screen">
 
<link href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('assets/css/styles.css') }}" rel="stylesheet"> 

<link href="{{ URL::asset('assets/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('assets/vendors/select/bootstrap-select.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('assets/vendors/tags/css/bootstrap-tags.css') }}" rel="stylesheet">

<link href="{{ URL::asset('assets/css/forms.css') }}" rel="stylesheet"> 

<link href="{{ URL::asset('assets/css/font-awesome.css') }}" rel="stylesheet">
 
</head>

<body>

 <div class="header">
  <div class="container">
    <div class="row">
      <div class="col-md-5"> 
        <!-- Logo -->
        <div class="logo">
          <h1><a href="index.html">UFCA - Controle de formulários</a></h1>
        </div>
      </div>

      <div class="col-md-5">
        <div class="row">
          <div class="col-lg-12">
            <div class="input-group form">
              <input type="text" class="form-control" placeholder="Pesquise aqui...">
              <span class="input-group-btn">
              <button class="btn btn-primary" type="button">Buscar</button>
              </span> </div>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="navbar navbar-inverse" role="banner">
          <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
            <ul class="nav navbar-nav">
              <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Minha conta <b class="caret"></b></a>
                <ul class="dropdown-menu animated fadeInUp">
                  <li><a href="profile.html">Perfil</a></li>
                  <li><a href="login.html">Sair</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      
    </div>
  </div>
</div>
 <div class="page-content">

  <div class="row">
    
    <div class="col-md-2">

      <div class="sidebar content-box" style="display: block;">
        <ul class="nav">
          <!-- Main menu -->
          <li><a href="{{ URL::to('/') }}"><i class="glyphicon glyphicon-home"></i> Início</a></li>
          <li class="submenu @yield('open-cadastrar-list')" > <a href="#"> <i class="glyphicon glyphicon-list"></i> Lista <span class="caret pull-right"></span> </a> 
            <!-- Sub menu -->
            <ul>
              <li @yield('current-open-cadastrar-list-cadastrar') ><a href="{{ URL::to('listas/cadastrar') }}">Cadastrar</a></li>
              <li @yield('current-open-listar-list-listar') ><a href="{{ URL::to('listas') }}">Listar</a></li>
            </ul>
          </li>
          <li class="submenu @yield('open-cadastrar-form') " > <a href="#"> <i class="glyphicon glyphicon-tasks"></i> Formulário <span class="caret pull-right"></span> </a> 
            <!-- Sub menu -->
            <ul>
              <li @yield('current-open-cadastrar-form-cadastrar') ><a href="{{ URL::to('formularios/cadastrar') }}">Cadastrar</a></li>
              <li @yield('current-open-listar-form-listar') ><a href="{{ URL::to('formularios') }}">Listar</a></li>
            </ul>
          </li>
           <li class="submenu @yield('open-cadastrar-user') "> <a href="#"> <i class="glyphicon glyphicon-user"></i> Usuário <span class="caret pull-right"></span> </a> 
            <!-- Sub menu -->
            <ul>
              <li @yield('current-open-cadastrar-user-cadastrar') ><a href="{{ URL::to('usuarios/cadastrar') }}">Cadastrar</a></li>
              <li @yield('current-open-listar-user-listar') ><a href="{{ URL::to('usuarios') }}">Listar</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>  

@yield('conteudo')

   </div>
 </div>


<footer>
  <div class="container">
    <div class="copy text-center"> Copyright 2014 <a href='#'>UFCA - Controle de formulários</a> </div>
  </div>
</footer> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://code.jquery.com/jquery.js"></script> 
<!-- jQuery UI --> 
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script> 
    
<script src="{{ URL::asset('assets/js/jquery-1.11.1.min.js') }}"></script> 
  
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>  

</body>
</html>
