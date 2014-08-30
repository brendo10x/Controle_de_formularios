@extends('layouts.default')

@section('titulo')
   Formulário do requisitante
@stop
@section('conteudo')
		<div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
          
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">
                <h2>Formulario do requisitante</h2>
              </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="{{ URL::to('usuarios/requisita') }}">
                <fieldset>
                  <legend>Básico</legend>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="text-field">Nome</label>
                    <div class="col-md-5">
                      <input class="form-control"  name="nome" required autofocus placeholder="Informe o nome" type="text">
                    </div>
                  </div>
                  <div class="form-group">
					<label for="inputEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-5">
						<input type="email" name="email" required class="form-control" id="inputEmail" placeholder="Informe um email de acesso">
					 </div>
				 </div>
                   <div class="form-group">
					  <label for="email1"  class="col-sm-2 control-label">Senha</label>
					     <div class="col-sm-5">
						   <input type="password" required  class="form-control" id="email1" placeholder="Informe uma senha de acesso">
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
@stop
 