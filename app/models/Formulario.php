<?php 
class Formulario extends Eloquent {
	
	protected $table = 'formularios';
	
	public function obterCampos()
    {
        return $this->hasMany('CampoFormulario');
    }
	
	public function obterItemListaFormulario()
    {
        return $this->hasMany('ItemListaFormulario');
    }
	
	
	 
}

?>