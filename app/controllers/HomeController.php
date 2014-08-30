<?php

class HomeController extends BaseController {

	// Layout padrão 
	//protected $layout = 'layouts.default';

	//Página padrão
	public function getIndex()
	{  
		return View::make('pages.formulario.listar'); 
	}


}
