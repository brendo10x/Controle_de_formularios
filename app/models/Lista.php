<?php 
class Lista extends Eloquent {
	
	protected $table = 'listas';
	
	public function obterItens()
    {
        return $this->hasMany('ItemLista');
    }
	
	public function obterCampoFormularioLista()
    {
        return $this->hasMany('CampoFormularioLista');
    }
	
	 
	
}

?>