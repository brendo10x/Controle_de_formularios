<?php

class ListaController extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| Controlador da lista. Por: Brendo Felipe - UFCA
	|--------------------------------------------------------------------------
	|
	 */
	
	// Layout padrão 
    protected $layout = 'layouts.default';
	
	//Chama a página de listagem
	public function getIndex()
	{	 
		$data['listas'] = self::listarTodos();
		$view = View::make('pages/lista/listar',$data);
		
		//Define o content com uma view
		$this->layout->content = $view;
		 
	}//fim getIndex
	
	//Chama a página de cadastro
	public function getCadastrar()
	{
		$data['formularios'] = Formulario::all();
		$this->layout->content = View::make('pages.lista.cadastrar',$data); 
		
	}//fim getCadastrar
	 
	//Recebe a requisição e o corpo com informações 
	public function postCadastrar()
	{	
	     //Lista
		 $lista = new Lista;
		 $lista->nome =  Input::get('nome');
		 $lista->ordenacao = Input::get('ordenacao');
		 $lista->save();
		 $ultimoIdLista = $lista->id; // Pega o último id
		 
		 $valores = Input::get('valor');
		 
		 //Vincular
		 $opcoes = Input::get('opcao');
		   
		 for ($i = 0; $i < count($valores); $i++){
		  	
			$itemLista = new ItemLista;
			$itemLista->valor = $valores[$i];
			$itemLista->lista_id = $ultimoIdLista;
			$itemLista->save();
			$ultimoIdItemLista = $itemLista->id;
			
			 
			//Criar e associar um item da lista a um formulário
			if($opcoes[$i] != 0){
				
				$itemListaFormulario = new ItemListaFormulario;
				$itemListaFormulario->item_lista_id = $ultimoIdItemLista;
				$itemListaFormulario->formulario_id = $opcoes[$i];
				$itemListaFormulario->save();
			}// fim if
		  
		 }//fim for
		 
		 
		 
		//Mensagem
		Session::flash('message-sucesso', 'Lista cadastrada com sucesso!');
		
		// Eedirecionamento
		return Redirect::to('listas');
		   
	}//fim postCadastrar
	
	 // Método que lista todos as listas
	 public function listarTodos(){
		
		return Lista::All();
	 }
	 
	 //Método que exclui as listas
	 public function postExcluir(){
		
		  //Obtém lista com ids
		 $idListas = Input::get('idLista');
		 
		 if(!empty($idListas)){
			 
			 //Item da lista
			 foreach($idListas as $id){
				 
				 // exclui
				 $lista = Lista::find($id);
				 $lista->delete();
				 
			 }//fim foreach
			  
	
			//Mensagem de sucesso
			Session::flash('message-sucesso', 'Excluído(s) com sucesso!');
			
		  }else{
			 
			 //Mensagem de atenção, pois é obrigatório selecionar pelo o menos um id para realizar a exclusão
			Session::flash('message-atencao', 'Atenção, selecione pelo o menos um item para ser excluído!');
		  }
		  
		// Eedirecionamento
		return Redirect::to('listas');
	 }
	 
	 //Página de editar lista
	 public function getEditar($id){
		  
		 $data['lista'] = Lista::find($id); 
		 $data['formularios'] = Formulario::all();
		  
		 $this->layout->content = View::make('pages.lista.editar',$data); 
		  
	 }// fim getEditar
	 
	 //Recebe a requisição e o corpo com informações 
	public function postEditar()
	{	
		 $lista = Lista::find(Input::get('id'));
	     //Lista 
		 $lista->nome =  Input::get('nome');
		 $lista->ordenacao = Input::get('ordenacao');
		 $lista->save();
		  
		  //Vincular
		  // idItemListaFormulario ou não
		  $opcoes = Input::get('opcao');
		  //Valor das listas
		  $valores = Input::get('valor'); 
		  $idItens = Input::get('todosOsIdsItem');
		  $idItemExcluir = Input::get('idItemExcluir');
		  
		 
		   //Excluir item já existente
			if(!empty($idItemExcluir)){
				   
				   for ($i = 0; $i < count($idItemExcluir); $i++){
							
						$itemLista = ItemLista::find($idItemExcluir[$i]);  
						$itemLista->delete();
						 
						$item = $idItemExcluir[$i];
						
						foreach (array_keys( $idItens, $item) as $key) {
							 
  							  unset($idItens[$key]);
						}
						 
						 
				 }
				    $mensagemExcluir = "Item(ens) excluído(s)";
			}// excluir
		   
		   
		  // Atualizar item lista
		  for ($i = 0; $i < count($idItens); $i++){
			   
			  //se for novo item
			 
				  //Item da lista
				  $itemLista = ItemLista::find($idItens[$i]);
				  $itemLista->valor = $valores[$i];
				  $itemLista->save();
				  
				  //verificar se lista tem alguma associação com algum formulário
				  if($opcoes[$i] == 0 ){
					  
					  if(isset($itemLista->obterItemListaFormulario['id'])){
						/// echo " Existe vinculo (Deleta)";
						  $itemListaFormulario = ItemListaFormulario::find($itemLista->obterItemListaFormulario['id']);
						  $itemListaFormulario->delete();
					  } 
					   
				  }else{
					  
					   if(isset($itemLista->obterItemListaFormulario['id'])){
						   //echo " Existe vinculo (atualiza)";
						   $itemListaFormulario = ItemListaFormulario::find($itemLista->obterItemListaFormulario['id']);
						   $itemListaFormulario->formulario_id = $opcoes[$i];
						   $itemListaFormulario->save();
					   }else{
						 //  echo "Não Existe vinculo (Cria)";
						   $itemListaFormulario = new ItemListaFormulario;
						   $itemListaFormulario->item_lista_id = $itemLista->id;
						   $itemListaFormulario->formulario_id = $opcoes[$i];
						   $itemListaFormulario->save(); 
					   }
				    
				 } 
				   
		  }// atualização
		  
		 
		  for ($i = 0; $i < count($valores); $i++){
			   
		  	 $itemLista = new ItemLista;
			 $itemLista-> valor = $valores[$i];
			 $itemLista->lista_id = $lista->id;
			 $itemLista->save(); 
						
				if($opcoes[$i] !=0){
					$itemListaFormulario = new ItemListaFormulario;
					$itemListaFormulario->item_lista_id = $itemLista->id;
					$itemListaFormulario->formulario_id = $opcoes[$i];
					$itemListaFormulario->save(); 
				}
		  
		  }
		   
		   /*//Adicionar
		   for ($i = 0; $i < count($valores); $i++){
			   
		   	//echo "Criar um novo item"  ;	
			
				if(!isset($idItens[$i]) ){
					
					$itemLista = new ItemLista;
					$itemLista-> valor = $valores[$i];
					$itemLista->lista_id = $lista->id;
					$itemLista->save(); 
					
					if($opcoes[$i] !=0){
						
				   	 	$itemListaFormulario = new ItemListaFormulario;
						$itemListaFormulario->item_lista_id = $itemLista->id;
						$itemListaFormulario->formulario_id = $opcoes[$i];
						$itemListaFormulario->save(); 
					}
				
					
				}	
		   }*/
		 
		 $mensagem = "";
		 
		 if(!empty($mensagemExcluir)){
			 
			  $mensagem = $mensagemExcluir." e lista atualizada com sucesso!";
			  
		 }else{
			   $mensagem.="\nLista atualizada com sucesso!";
		  }
		  
		//Mensagem
		Session::flash('message-sucesso', $mensagem);
		
		// Eedirecionamento
		return Redirect::to('listas/editar/'. $lista->id);
		   
	}//fim postCadastrar

}
