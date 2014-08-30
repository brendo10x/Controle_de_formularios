 @foreach ($formulario->obterCampos as $campo)  
         @if ($campo->tipo == 0)
         
               <div class="form-group">
                <label class="control-label col-md-2">{{ $campo->obterCampoFormularioLista->obterLista->nome }}</label>
                <div class="col-md-5">
                  <select  onChange="chamarSubForm(this.value);" name="setor" class="form-control subForm">
             		 
                     @foreach ($campo->obterCampoFormularioLista->obterLista->obterItens as $itemLista)
                      	  <option
                           
                          @if(isset($itemLista->obterItemListaFormulario['id']))
                             class="subform" value="{{ $itemLista->obterItemListaFormulario['formulario_id'] }}"
                          @else
                              value="{{ $itemLista->valor }}" 
                          @endif 
                            
                           >
                            {{ $itemLista->valor }}  
                            </option>  
                     @endforeach
              
                  </select>
                </div>
              </div>
              
              
         @endif
          
         @if ($campo->tipo == 1)
             <div class="form-group">
              <label class="col-sm-2 control-label">{{ $campo->rotulo }}</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="{{ $campo->variavel }}" {{{ ($campo->obrigatorio == 1) ? 'required ' : '' }}}  rows="3"></textarea>
                </div>
            </div>
         @endif
         
        
         @if ($campo->tipo == 2)
             <div class="form-group">
              <label class="col-md-2 control-label" for="text-field">{{ $campo->rotulo }}</label>
              <div class="col-md-5">
                <input class="form-control"  name="{{ $campo->variavel }}" {{{ ($campo->obrigatorio == 1) ? 'required ' : '' }}}  type="text">
              </div>
            </div>
             
         @endif
         
         
         @if ($campo->tipo == 3)
           <div class="form-group">
              <label class="col-md-2 control-label" for="text-field">{{ $campo->rotulo }}</label>
              <div class="col-md-3">
                <input class="form-control"  name="{{ $campo->variavel }}" {{{ ($campo->obrigatorio == 1) ? 'required ' : '' }}}  type="number">
              </div>
            </div>
         @endif
         
         
         @if ($campo->tipo == 4)
          <div class="form-group">
              <label class="col-md-2 control-label" for="text-field">{{ $campo->rotulo }}</label>
              <div class="col-md-3">
                <input class="form-control"  name="{{ $campo->variavel }}" {{{ ($campo->obrigatorio == 1) ? 'required ' : '' }}}  type="text">
              </div>
            </div>
         @endif
         
         
         @if ($campo->tipo == 5)
            <div class="form-group">
              <label class="col-md-2 control-label" for="text-field">{{ $campo->rotulo }}</label>
              <div class="col-md-3">
                <input class="form-control"  name="{{ $campo->variavel }}" {{{ ($campo->obrigatorio == 1) ? 'required ' : '' }}}  type="tel">
              </div>
            </div>
         @endif
         
          
         @if ($campo->tipo == 6)
              <div class="form-group">
              <label class="col-md-2 control-label" for="text-field">{{ $campo->rotulo }}</label>
              <div class="col-md-5">
                <input class="form-control"  name="{{ $campo->variavel }}" {{{ ($campo->obrigatorio == 1) ? 'required ' : '' }}}  type="email">
              </div>
            </div>
         @endif 
  @endforeach