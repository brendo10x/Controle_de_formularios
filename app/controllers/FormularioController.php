<?php

class FormularioController extends BaseController {

	 /*
	|--------------------------------------------------------------------------
	| Página de formulário
	|--------------------------------------------------------------------------
	|
	 */

 	// Layout padrão 
    protected $layout = 'layouts.default';


    // Chama a página de listar formulários
	public function getIndex()
	{
		
		$data['formularios'] = self::listarTodos();
		
		// defina a view 
		$view = View::make('pages.formulario.listar',$data);  

		// defina o layout com a view(conteúdo)
		$this->layout->content = $view;

	}
 
	
	// Chama a página de chamar a função cadastrar formulários
	public function getCadastrar()
	{
	 
		$data['listas'] = Lista::all();
		
			// defina a view 
		$view = View::make('pages.formulario.cadastrar',$data); 
			
		// defina o layout com a view(conteúdo)
		$this->layout->content = $view;
		 
	}
	
	
	//Recebe a requisição e o corpo com informações 
	public function postCadastrar()
	{
		//Salvar formulário
		$formulario = new Formulario;
		$formulario->nome = Input::get('nome');
		$formulario->instrucao = Input::get('nome');
		$formulario->save();
		$ultimoIdFormulario = $formulario->id; // Pega o último id
		
		//Salvar campo formulário
		$rotulos = Input::get('rotulo');
		$obrigatorios = Input::get('obrigatorio');
		$variaveis = Input::get('variavel');
		$tipos = Input::get('tipo');
		
		 for ($i = 0; $i < count($rotulos); $i++){
			 
			//salvar campo 
 		   	$campoFormulario = new CampoFormulario;
			$campoFormulario->rotulo = $rotulos[$i];
			$campoFormulario->obrigatorio =  $obrigatorios[$i]; // (0 - Não) ou (1 - Sim) obrigatório 
			$campoFormulario->tipo = self::tipoCampo($tipos[$i]);
			$campoFormulario->variavel = $variaveis[$i];
			$campoFormulario->formulario_id = $ultimoIdFormulario;
			$campoFormulario->save();
			$ultimoIdCampoFormulario = $campoFormulario->id;
			   
			//Se o campo for um select ele vai está associado a lista
			if($campoFormulario->tipo == 0){
				
				$campoFormularioLista = new CampoFormularioLista;
				$campoFormularioLista->lista_id = $tipos[$i];
				$campoFormularioLista->campo_formulario_id = $ultimoIdCampoFormulario;
				$campoFormularioLista->save();
			}
			 
		 }
		 
		 
		//Mensagem
		Session::flash('message-sucesso', 'Formulário cadastrado com sucesso!');
		
		// Eedirecionamento
		return Redirect::to('formularios');
		 
	}//fim postCadastrar
	
	  
	
	//Aqui retorna o campo
	public function tipoCampo($valor){
		
		if(is_int($valor)){  
			//Select
			return  0; 
		} 
			$idCampo = 0 ;
			
			switch ($valor) {
				case 'textarea':
				    // TextArea
					$idCampo = 1;
					break;
				case 'text':
					// Text
					$idCampo = 2;
					break;
				case 'num':
				    // Number
					$idCampo = 3;
					break;
				case 'datetime':
					// Datetime
					$idCampo = 4;
					break;
				case 'phone':
					// Phone
					$idCampo = 5;
					break;
					
				case 'email':
					// Email
					$idCampo = 6;
					break; 
		   }
		    
			return $idCampo;
		
	}// fim tipoCampo
	
	
	// Método que lista todos
	 public function listarTodos(){
		
		return Formulario::All();
	 }
	 
	 //Método que exclui as listas
	 public function postExcluir(){
		
		  //Obtém lista com ids
		 $idFormularios = Input::get('idFormulario');
		 
		 if(!empty($idFormularios)){
			 
			 //Item da lista
			 foreach($idFormularios as $id){
				 
				 // exclui
				 $formulario = Formulario::find($id);
				 $formulario->delete();
				 
			 }//fim foreach
			   
			//Mensagem de sucesso
			Session::flash('message-sucesso', 'Excluído(s) com sucesso!');
			
		  }else{
			 
			 //Mensagem de atenção, pois é obrigatório selecionar pelo o menos um id para realizar a exclusão
			Session::flash('message-atencao', 'Atenção, selecione pelo o menos um item para ser excluído!');
		  }
		  
		// Eedirecionamento
		return Redirect::to('formularios');
	 }
	
	 //Página de editar lista
	 public function getEditar($id){
		  
		 $data['listas'] = Lista::all();
		 $data['formulario'] = Formulario::find($id);
		 
		 $this->layout->content = View::make('pages.formulario.editar',$data); 
		  
	 }// fim getEditar
	 
	 //Recebe a requisição e o corpo com informações 
	public function postEditar()
	{	
		 //Atualizar formulário
		 $formulario = Formulario::find(Input::get('idFormulario'));
		 $formulario->nome = Input::get('nome');
		 $formulario->instrucao = Input::get('instrucao');
		 $formulario->save();
		 
		 //Atualizar campos
		 //Vincular
		 $rotulos = Input::get('rotulo');
		 $tipos = Input::get('tipo');
		 $obrigatorios = Input::get('obrigatorio');
		 $variaveis = Input::get('variavel');
	
		  
		 //ids
		 $idCampos = Input::get('todosOsIdsCampos');
		 $idCampoExcluir = Input::get('idCampoExcluir');
		  
		   for ($i = 0; $i < count($idCampos); $i++){
			    
				 //se for novo item
			 	if($idCampos[$i] == 0){
					
					//salvar campo 
					$campoFormulario = new CampoFormulario;
					$campoFormulario->rotulo = $rotulos[$i];
					$campoFormulario->obrigatorio =  $obrigatorios[$i]; // (0 - Não) ou (1 - Sim) obrigatório 
					$campoFormulario->tipo = self::tipoCampo($tipos[$i]);
					$campoFormulario->variavel = $variaveis[$i];  
					$campoFormulario->formulario_id = $formulario->id;
					$campoFormulario->save(); 
					
					   
					//Se o campo for um select ele vai está associado a lista
					if($campoFormulario->tipo == 0){
						
						$campoFormularioLista = new CampoFormularioLista;
						$campoFormularioLista->lista_id = $tipos[$i]; 
						$campoFormularioLista->campo_formulario_id = $campoFormulario->id;
						$campoFormularioLista->save();
						
					}//fim if
					
				}else{
					
					//Atualizar campo
					$campoFormulario = CampoFormulario::find($idCampos[$i]);
					$campoFormulario->rotulo = $rotulos[$i];
					$campoFormulario->obrigatorio =  $obrigatorios[$i]; // (0 - Não) ou (1 - Sim) obrigatório 
					$campoFormulario->tipo = self::tipoCampo($tipos[$i]);
					$campoFormulario->variavel = $variaveis[$i];   
					$campoFormulario->save(); 
					
					$tipo = self::tipoCampo($tipos[$i]) ;
					 
					if( isset($campoFormulario->obterCampoFormularioLista['id']) ){
						 
						 if($campoFormulario->tipo == 0){
						   // Atualiza OK se ele era lista e escolheu outra lista está ok atualiza
						    echo "Atualiza campo_formulario_lista id: ".$campoFormulario->obterCampoFormularioLista['id'];
							$campoFormularioLista = CampoFormularioLista::find($campoFormulario->obterCampoFormularioLista['id']);
							$campoFormularioLista->lista_id = $tipos[$i];
							$campoFormularioLista->save();
						  
						  }else{
						  
						     //  echo "Deleta"; OK
							  echo "Deleta campo_formulario_lista id: ".$campoFormulario->obterCampoFormularioLista['id'];
							  $campoFormularioLista = CampoFormularioLista::find($campoFormulario->obterCampoFormularioLista['id']);
							  $campoFormularioLista->delete();	
						  
						  }
						 
					}else{
						
						if($campoFormulario->tipo == 0){
							//Criar OK
							echo ", Criar campo_formulario_lista id: ".$campoFormulario->obterCampoFormularioLista['id'];
							$campoFormularioLista = new CampoFormularioLista();
							$campoFormularioLista->lista_id = $tipos[$i];
							$campoFormularioLista->campo_formulario_id = $campoFormulario->id;
							$campoFormularioLista->save();
						  
						}
						  
					}
					 
					  
					
				}
	       
		   }
		   
		    //Excluir item já existente
			//Deixar sempre no final esta lógica
			if(!empty($idCampoExcluir)){
				   
				   for ($i = 0; $i < count($idCampoExcluir); $i++){
							
						$campoFormulario = CampoFormulario::find($idCampoExcluir[$i]);  
						$campoFormulario->delete();
						  
				 }
				    $mensagemExcluir = "Campo(s) excluído(s)";
			}// excluir
		   
		   
		 $mensagem = "";
		 
		 if(!empty($mensagemExcluir)){
			 
			  $mensagem = $mensagemExcluir." e formulario atualizado com sucesso!";
			  
		 }else{
			   $mensagem.="Formulário atualizado com sucesso!";
		  }
		   
		   //Mensagem
		Session::flash('message-sucesso', $mensagem);
		
		// Eedirecionamento
		return Redirect::to('formularios/editar/'. $formulario->id);
		 
	}
}
