<?php

class UsuarioController extends BaseController {

	 
	protected $layout = 'layouts.default';

	public function getIndex()
	{

		$data['usuarios'] = Usuario::all();

		$this->layout->content = View::make('pages.usuario.listar',$data); 
	}

	public function getCadastrar()
	{
		$this->layout->content = View::make('pages.usuario.cadastrar'); 
	}
	
	public function postCadastrar()
	{
		$usuario = new Usuario;
		$usuario->nome = Input::get('nome');
		$usuario->email = Input::get('email');
		$usuario->senha = Input::get('senha');
		$usuario->save();
		
		//Mensagem
		Session::flash('message-sucesso', 'Usuário cadastrado com sucesso!');
		
		// Eedirecionamento
		return Redirect::to('usuarios');
	}
	
	 //Recebe a requisição e o corpo com informações 
	public function getEditar($id)
	{	
		 
		 $data['usuario'] = Usuario::find($id);
		 
		 $this->layout->content = View::make('pages.usuario.editar',$data); 
	}
	
	 //Recebe a requisição e o corpo com informações 
	public function postEditar()
	{	
		$usuario = Usuario::find(Input::get('id'));
		$usuario->nome = Input::get('nome');
		$usuario->email = Input::get('email');
		$usuario->senha = Input::get('senha');
		$usuario->save();
		
		   //Mensagem
		Session::flash('message-sucesso', 'Usuário atualizado com sucesso!');
		
		// Eedirecionamento
		return Redirect::to('usuarios/editar/'. $usuario->id);
	}
	
	//Método que exclui os usuários
	 public function postExcluir(){
	 	
	   //Obtém lista com ids
		 $idUsuarios = Input::get('idUsuario');
		 
		 if(!empty($idUsuarios)){
			 
			 //Item da lista
			 foreach($idUsuarios as $id){
				 
				 // exclui
				 $usuario = Usuario::find($id);
				 $usuario->delete();
				 
			 }//fim foreach
			   
			//Mensagem de sucesso
			Session::flash('message-sucesso', 'Excluído(s) com sucesso!');
			
		  }else{
			 
			 //Mensagem de atenção, pois é obrigatório selecionar pelo o menos um id para realizar a exclusão
			Session::flash('message-atencao', 'Atenção, selecione pelo o menos um item para ser excluído!');
		  }
		  
		// Eedirecionamento
		return Redirect::to('usuarios');
		 
	 }
}
