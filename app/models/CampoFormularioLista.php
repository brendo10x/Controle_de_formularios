<?php 
class CampoFormularioLista extends Eloquent {
	
	protected $table = 'campo_formulario_lista';
	
	public function obterLista()
    {
        return $this->belongsTo('Lista','lista_id');
    } 
	
	public function obterCampoFormulario()
    {
        return $this->belongsTo('CampoFormulario','campo_formulario_id');
    } 
}

?>