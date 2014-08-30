@extends('layouts.default')

@section('titulo')
  Cadastrar lista
@stop

@section('open-cadastrar-list') open @stop

@section('current-open-cadastrar-list-cadastrar') class="current" @stop

@section('conteudo')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12">
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Início</a></li>
        <li class="active">Cadastrar</li>
        <li class="active">Lista</li>
      </ol>
      <div class="content-box-large">
        <div class="panel-heading">
          <div class="panel-title">
            <h2>Cadastrar lista</h2>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="post" action="{{ URL::to('listas/cadastrar') }}">
            <fieldset>
              <legend>Básico</legend>
              <div class="form-group">
                <label class="col-md-2 control-label" for="text-field">Nome</label>
                <div class="col-md-5">
                  <input class="form-control" name="nome" autofocus required  placeholder="Informe o nome" type="text">
                </div>
              </div>
              
              <div class="form-group"> 
                <label class="col-md-2 control-label">Principal</label>
                <div class="col-md-5">
                  <label class="radio radio-inline">
                    <input name="principal" checked value="1" type="radio" />
                    Sim </label>
                  <label class="radio radio-inline">
                    <input name="principal" value="0"  type="radio" />
                    Não </label> 
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-2">Ordenação</label>
                <div class="col-md-5">
                  <select name="ordenacao" class="form-control">
                    <option value="1">Alfabética</option>
                    <option value="2">Alfabética (Reverso)</option>
                  </select>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Itens</legend>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="panel-body">
                    <table class="table table-condensed" id="tabela-campos">
                      <thead>
                        <tr>
                          <th class="col-md-5">Valor</th>
                          <th class="col-md-5">Subformulário</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="permanente">
                          <td><input class="form-control" required name="valor[]" placeholder="Informe um valor" type="text"></td>
                          <td class="select-form"><select name="opcao[]" id="opcoes" class="form-control">
                              <optgroup label="Chamar formulário?">
                              <option value="0"> Não </option>
                              </optgroup>
                              <optgroup label="Formulário"> 
                                   @forelse($formularios as $formulario)
                                      
                              <option value="{{ $formulario->id }}" >{{ $formulario->nome }}</option>
                               
                                    @empty
                                    	 
                                    @endforelse 
                                    </optgroup>
                            </select></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12"> <a id="addCampo" class="btn btn-default" > <i class="glyphicon glyphicon-plus-sign"></i> </a> <a id="revCampo" class="btn btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> </a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success" type="submit"> Salvar </button>
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