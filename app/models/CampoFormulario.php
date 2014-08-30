<?php 

class CampoFormulario extends Eloquent {
	
	protected $table = 'campo_formulario';
	
	public function obterFormulario()
    {
        return $this->belongsTo('Formulario','formulario_id');
    }
	 
	 public function obterCampoFormularioLista()
    {
        return $this->hasOne('CampoFormularioLista');
    }
}

?>