@extends('layouts.default')

@section('titulo')
  Cadastrar usuário
@stop

@section('open-cadastrar-user') open @stop
 

@section('conteudo')
	<div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Início</a></li>
            <li class="active">Editar</li>
            <li class="active">Usuário</li>
          </ol>
          
          <!-- Mensagem de sucesso -->
		@if (Session::has('message-sucesso'))
		<div class="alert alert-success" role="alert">{{ Session::get('message-sucesso') }}</div>
		@endif
        
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">
                <h2>Editar usuário</h2>
              </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="{{ URL::to('usuarios/editar') }}">
                <input type="hidden"  name="id" value="{{ $usuario->id }}" />
                <fieldset>
                  <legend>Básico</legend>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="text-field">Nome</label>
                    <div class="col-md-5">
                      <input class="form-control" value="{{ $usuario->nome }}" name="nome" required autofocus placeholder="Informe o nome" type="text">
                    </div>
                  </div>
                  <div class="form-group">
					<label for="inputEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-5">
						<input type="email" name="email" value="{{ $usuario->email }}" required class="form-control" id="inputEmail" placeholder="Informe um email de acesso">
					 </div>
				 </div>
                   <div class="form-group">
					  <label for="email1"  class="col-sm-2 control-label">Senha</label>
					     <div class="col-sm-5">
						   <input type="password" required  value="{{ $usuario->senha }}" class="form-control" id="email1" placeholder="Informe uma senha de acesso">
						</div>
				   </div>
                   <div class="form-group">
					  <label for="email2"  class="col-sm-2 control-label">Confirme Senha</label>
					     <div class="col-sm-5">
						   <input type="password"  oninput="check(this)" required name="senha" class="form-control"  id="email2" placeholder="Confirme a senha">
						</div>
				   </div>
                </fieldset>
                 
                
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-success"  type="submit">  Salvar </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
 <script>
function check(input) {
  if (input.value != document.getElementById('email1').value) {
    input.setCustomValidity('As duas senhas devem corresponder.');
  } else {
    // input is valid -- reset the error message
    input.setCustomValidity('');
  }
}
</script>
    
@stop