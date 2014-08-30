@extends('layouts.default')

@section('titulo') Editar formulário @stop

@section('open-cadastrar-form') open @stop

  
@section('conteudo')
		
 <div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Início</a></li>
            <li class="active">Editar</li>
            <li class="active">Formulário</li>
          </ol>
          
          <!-- Mensagem de sucesso -->
		@if (Session::has('message-sucesso'))
		<div class="alert alert-success" role="alert">{{ Session::get('message-sucesso') }}</div>
		@endif
          
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">
                <h2>Editar formulário</h2>
              </div>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" method="post" action="{{ URL::to('formularios/editar') }}">
              
              <input type="hidden" name="idFormulario" value="{{ $formulario->id }}" />
                <fieldset>
                  <legend>Básico</legend>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="text-field">Nome</label>
                    <div class="col-md-5">
                      <input class="form-control" name="nome" autofocus required  value="{{ $formulario->nome }}" placeholder="Informe o nome" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Instruções</label>
                    <div class="col-sm-5">
                      <textarea class="form-control" name="instrucao" required placeholder="Informe algumas instruções" rows="3">{{ $formulario->instrucao }}</textarea>
                    </div>
                  </div>
                </fieldset>
                <fieldset>
                  <legend>Campos</legend>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="panel-body">
                        <table class="table table-condensed" id="tabela-campos">
                          <thead>
                            <tr>
                              <th class="col-md-3">Rótulo</th>
                              <th class="col-md-3">Tipo</th>
                              <th class="col-md-1">Obrigatório</th>
                              <th class="col-md-3">Variável</th>
                              <th class="col-md-1">Excluir</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                           @forelse($formulario->obterCampos as $campo)
                            <tr class="permanente"  >
                              <td><input name="rotulo[]" class="form-control" value="{{ $campo->rotulo }}" placeholder="Informe um valor" type="text"></td>
                              <td class="select-form">
                                
                              <select name="tipo[]"  id="opcoes" class="form-control">
                                  <optgroup label="Campos básicos">
                                      <option {{{ $campo['tipo'] == 1 ? 'selected="selected" ' : '' }}} value="textarea"> Texto longo</option>
                                      <option {{{ $campo['tipo'] == 2 ? 'selected="selected" ' : '' }}} value="text"> Texto curto</option>
                                      <option {{{ $campo['tipo'] == 3 ? 'selected="selected" ' : '' }}} value="num"> Número </option>
                                      <option {{{ $campo['tipo'] == 4 ? 'selected="selected" ' : '' }}} value="datetime"> Data e Hora</option>
                                      <option {{{ $campo['tipo'] == 5 ? 'selected="selected" ' : '' }}} value="phone"> Telefone</option>
                                      <option {{{ $campo['tipo'] == 6 ? 'selected="selected" ' : '' }}} value="email"> Email</option> 
                                  </optgroup>
                                  <optgroup label="Listas"> 
                                     @forelse($listas as $lista) 
                                      <option {{ $campo->obterCampoFormularioLista['lista_id'] == $lista->id ? ' selected="selected" ' : '' }} value="{{ $lista->id }}" >{{ $lista->nome }}</option> 
                                    @empty
                                    
                                    
                                    	 
                                    @endforelse
                                    </optgroup>
                                    
                                </select>
                                </td>
                              <td>
                              <select name="obrigatorio[]" class="form-control">
                               		 <option  {{ $campo['obrigatorio'] == 0 ? 'selected="selected" ' : ''  }} value="0"> Não</option> 
                                     <option {{ $campo['obrigatorio'] == 1 ? 'selected="selected"' : '' }} value="1"> Sim</option> 
                              </select>
                              </td>
                              <td><input value="{{$campo->variavel}}" required name="variavel[]" class="form-control" placeholder="Informe um valor" type="text"></td>
                              <td><input value="{{ $campo->id }}" name="idCampoExcluir[]" type="checkbox"></td>
                              <input type="hidden" value="{{ $campo->id }}" name="todosOsIdsCampos[]" />
                            </tr>
                             
                             @empty
                             <input type="hidden" value="0" name="todosOsIdsCampos[]" />
                             <tr class="permanente"  >
                              <td><input name="rotulo[]" class="form-control"  placeholder="Informe um valor" type="text"></td>
                              <td class="select-form">
                                
                              <select name="tipo[]"  id="opcoes" class="form-control">
                                  <optgroup label="Campos básicos">
                                      <option  value="textarea"> Texto longo</option>
                                      <option  value="text"> Texto curto</option>
                                      <option  value="num"> Número </option>
                                      <option  value="datetime"> Data e Hora</option>
                                      <option  value="phone"> Telefone</option>
                                      <option  value="email"> Email</option> 
                                  </optgroup>
                                  <optgroup label="Listas"> 
                                     @forelse($listas as $lista) 
                                      <option value="{{ $lista->id }}" >{{ $lista->nome }}</option> 
                                    @empty
                                    
                                     
                                    @endforelse
                                    </optgroup>
                                    
                                </select>
                                </td>
                              <td>
                              <select name="obrigatorio[]" class="form-control">
                               		 <option value="0"> Não</option> 
                                     <option value="1"> Sim</option> 
                              </select>
                              </td>
                              <td><input required name="variavel[]" class="form-control" placeholder="Informe um valor" type="text"></td>
                              <td></td>
                               
                            </tr>
                             
                             @endforelse
                          </tbody>
                        </table>
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12"> <a id="addCampoForm" class="btn btn-default" > <i class="glyphicon glyphicon-plus-sign"></i> </a> <a  id="revCampoForm" class="btn btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-success" type="submit">  Salvar </button>
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

 