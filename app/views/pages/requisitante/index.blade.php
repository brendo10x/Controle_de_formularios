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
            <h2> Formulário do requisitante</h2>
          </div>
        </div>
        <div class="panel-body">
          <form id="formRequisitante"  class="form-horizontal" method="post" action="{{ URL::to('requisitantes/requisitar') }}">
            <fieldset>
              <legend>Dados pessoais</legend>
              <div class="form-group">
                <label class="col-md-2 control-label" for="text-field">Nome</label>
                <div class="col-md-5">
                  <input class="form-control"  name="nome" required autofocus placeholder="Informe o nome" type="text">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-md-5">
                  <input type="email" name="email" required class="form-control" id="inputEmail" placeholder="Informe seu email para receber atualizações">
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Informações específicas do setor</legend>
              <div class="form-group">
                <label class="control-label col-md-2">Setor</label>
                <div class="col-md-5">
                  <select id="selectSetor" name="setor" class="form-control">
                    <option value="0" >Selecione um setor</option>
                     
                  @foreach ($listas as $lista) 
                    <option  value="{{ $lista->id }}">{{ $lista->nome }}</option> 
				  @endforeach
                       
                  </select>
                </div>
              </div>
              <div id="setor"></div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Mensagem</label>
                <div class="col-sm-5">
                  <textarea  name="assunto" class="form-control" placeholder="Informe seu assunto" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Anexo</label>
                <div class="col-md-10">
                  <input type="file" class="btn btn-default" id="exampleInputFile1">
                  <p class="help-block">Tamanho máximo do arquivo 100kb </p>
                </div>
              </div>
            </fieldset>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success"  type="submit"> Salvar </button>
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
  

</script> 
@stop 