@extends('layouts.default')

@section('titulo')
  Editar lista
@stop

@section('open-cadastrar-list') open @stop
 
@section('conteudo')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12">
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Início</a></li>
        <li class="active">Editar</li>
        <li class="active">Lista</li>
      </ol>
      
      <!-- Mensagem de sucesso --> 
      @if (Session::has('message-sucesso'))
      <div class="alert alert-success" role="alert">{{ Session::get('message-sucesso') }}</div>
      @endif
      <div class="content-box-large">
        <div class="panel-heading">
          <div class="panel-title">
            <h2>Editar lista</h2>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="post" action="{{ URL::to('listas/editar') }}">
            <fieldset>
              <legend>Básico</legend>
              <input type="hidden" value="{{ $lista->id }}"  name="id"  />
              <div class="form-group">
                <label class="col-md-2 control-label" for="text-field">Nome</label>
                <div class="col-md-5">
                  <input class="form-control" name="nome" value="{{ $lista->nome }}" autofocus required  placeholder="Informe o nome" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Principal</label>
                <div class="col-md-5">
                  <label class="radio radio-inline">
                    <input name="principal" {{{ ($lista->principal == 1) ? 'checked ' : '' }}} value="1" type="radio" />
                    Sim </label>
                  <label class="radio radio-inline">
                    <input name="principal" {{{ ($lista->principal == 0) ? 'checked ' : '' }}} value="0"  type="radio" />
                    Não </label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2">Ordenação</label>
                <div class="col-md-5">
                  <select name="ordenacao" class="form-control">
                    <option {{{ ($lista->ordenacao == 1) ? 'selected="selected"' : '' }}} value="1">Alfabética</option>
                    <option {{{  ($lista->ordenacao == 2) ? 'selected="selected"' : '' }}} value="2">Alfabética (Reverso)</option>
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
                          <th class="col-md-2">Excluir</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @forelse($lista->obterItens as $item)
                      <tr class="permanente" >
                        <td><input class="form-control" value="{{ $item->valor }}" required name="valor[]" placeholder="Informe um valor" type="text"></td>
                        <td class="select-form"><select id="opcoes" name="opcao[]" class="form-control">
                            <optgroup label="Chamar formulário?">
                            <option {{{ isset($item->obterItemListaFormulario['formulario_id']) ? 'selected="selected" ' : '' }}} value="0"> Não </option>
                            </optgroup>
                            <optgroup label="Formulário"> 
                                     @forelse($formularios as $formulario)
                                       
                                     	   
                            <option  {{ $item->obterItemListaFormulario['formulario_id'] == $formulario->id ?  'selected="selected" ' : '' }}  value="{{ $formulario->id }}"> {{ $formulario->nome }} </option>
                             
                                        
                                     @empty
                                    
                                     @endforelse
                                    </optgroup>
                          </select></td>
                        <td><input value="{{ $item->id }}" name="idItemExcluir[]" type="checkbox"></td>
                      </tr>
                      <input type="hidden" value="{{ $item->id }}" name="todosOsIdsItem[]" />
                      @empty
                      <input type="hidden" value="0" name="todosOsIdsItem[]" />
                      <tr>
                        <td><input name="valor[]" required  class="form-control" placeholder="Informe o valor" type="text"></td>
                        <td><select id="opcoes" name="opcao[]"  class="form-control">
                            <optgroup label="Chamar formulário?">
                            <option  value="0"> Não </option>
                            </optgroup>
                            <optgroup label="Formulário"> 
                                 @foreach($formularios as $formulario)
                                       
                            <option value="{{ $formulario->id }}"> {{ $formulario->nome }} </option>
                             
                                 @endforeach
                                 </optgroup>
                          </select></td>
                      </tr>
                      @endforelse
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