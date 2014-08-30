<?php 
class ItemListaFormulario extends Eloquent {
	
	protected $table = 'item_lista_formulario';
	
	public function obterItemLista()
    {
        return $this->belongsTo('ItemLista','item_lista_id');
    }
	
	public function obterFormulario()
    {
        return $this->belongsTo('Formulario','formulario_id');
    }
}

?>