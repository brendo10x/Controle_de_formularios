<?php 
class ItemLista extends Eloquent {
	
	protected $table = 'item_lista';
	
	public function obterLista()
    {
        return $this->belongsTo('Lista','lista_id');
    } 
	
	public function obterItemListaFormulario()
    {
        return  $this->hasOne('ItemListaFormulario');
    }
}

?>