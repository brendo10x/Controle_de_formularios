<?php

class RequisitanteController extends BaseController {

	 
	protected $layout = 'layouts.default';

	public function getIndex()
	{	
		//Obtém todas as listas principais. (0 - não) (1 - Sim) principal
  		$data['listas'] = Lista::whereRaw('principal = ? ', array(1))->get();
	 	 
		$this->layout->content = View::make('pages.requisitante.index',$data); 
	}

}
