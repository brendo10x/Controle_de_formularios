<?php
 

// Página inicial

Route::get('/', 'RequisitanteController@getIndex');
 
// Listas /Cadastrar/ Listar / Editar / Excluir
Route::controller('listas', 'ListaController');  

// Formulários /Cadastrar/ Listar / Editar / Excluir
Route::controller('formularios', 'FormularioController');

// Usuários /Cadastrar/ Listar / Editar / Excluir
Route::controller('usuarios', 'UsuarioController');

// Operações para o requisitante
Route::controller('requisitantes', 'RequisitanteController');