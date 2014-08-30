@extends('layouts.default')

@section('titulo') Listar formulários @stop
  
@section('open-cadastrar-form') open @stop

@section('current-open-listar-form-listar') class="current" @stop

@section('conteudo')

 <div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Início</a></li>
            <li class="active">Listar</li>
            <li class="active">Formulários</li>
          </ol>
           <!-- Mensagem de sucesso -->
		@if (Session::has('message-sucesso'))
		<div class="alert alert-success" role="alert">{{ Session::get('message-sucesso') }}</div>
		@endif
        
         <!-- Mensagem de atenção -->
		@if (Session::has('message-atencao'))
        <div class="alert alert-warning" role="alert">{{ Session::get('message-atencao') }}</div>
        @endif
          
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">
                <h2>Listar formulários</h2>
              </div>
            </div>
            <div class="panel-body">
              <form action="{{ URL::to('formularios/excluir') }}" method="post" >
              <table class="table table-hover">
                <thead>
                  <tr>
                   <th class="col-md-1"> Exluir</th>
                     <th>Nome</th> 
                    <th class="col-md-1">#</th> 
                  </tr>
                </thead>
                <tbody>
                
                @forelse($formularios as $formulario)
                     <tr>  
                        <td><input name="idFormulario[]" value="{{ $formulario->id }}" type="checkbox"></td>
                         <td>{{ $formulario->nome }}</td>
                        <td><a href="{{ URL::to('formularios/editar').'/'.$formulario->id }}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-refresh"></i> Atualizar</a></td> 
                      </tr>
                    @empty
                     <tr> 
                      <td colspan="3">Não contém nenhuma formularios cadastrado. </td>
                     </tr> 
                    @endforelse
                   
                </tbody>
              </table>
               @if (count($formularios) >= 1)
                  <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-danger btn-sm" type="submit"> <i class="glyphicon glyphicon-remove"></i>  Excluir selecionado(s) </button>
                        </div>
                      </div>
                    </div>
             @endif
               </form>
            </div>
          </div>
        </div>
      </div>
    </div>

@stop