

$(document).ready(function(){
	
function check(input) {
	  if (input.value != document.getElementById('email1').value) {
		input.setCustomValidity('As duas senhas devem corresponder');
	  } else {
		// input is valid -- reset the error message
		input.setCustomValidity('');
	  }
	}

  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
  
// Por: Brendo Felipe  - 21/08/2014 - 21/08/2014 10:28
// Função de adicionar campo



///Função para a tela de cadastro de lista

//Var i é global usada nas funções
//Obtem todos o nº de elementos da tr desta condição
var i = $('#tabela-campos tbody tr').size()+1;

//Função de adicionar campos 
$('a#addCampo').click(function(){
	
	opcoesSelect = $('#opcoes').html();
	 
	htmlCampo ='<tr>';
	htmlCampo+='<td><input name="valor[]" required  class="form-control" placeholder="Informe o valor" type="text"></td>';
	htmlCampo+='<td><select name="opcao[]"  class="form-control">'+opcoesSelect+'</select></td>';
	htmlCampo+='<input type="hidden" value="0" name="todosOsIdsItem[]" />';
	htmlCampo+='</tr>';
	$(htmlCampo).appendTo('#tabela-campos tbody');
	
	i++;
	
});

//Função de remover itens da lista
$('a#revCampo').click(function(){
	 
	  
	 if($('#tabela-campos tbody tr:last').hasClass( "permanente" )){
		 
	 }else{
		 
		 $('#tabela-campos tbody tr:last').remove();
	 }
	  
	 i--;
});



//Função para a página de cadastro de formulário
 
//Função de adicionar campos 
$('a#addCampoForm').click(function(){
	
	opcoesSelect = $('#opcoes').html();
	 
	htmlCampo ='<tr>';
	htmlCampo+='<td><input name="rotulo[]" required  class="form-control" placeholder="Informe o valor" type="text"></td>';
	htmlCampo+='<td><select name="tipo[]" class="form-control">'+opcoesSelect+'</select></td>'; 
	htmlCampo+='<td><select name="obrigatorio[]" class="form-control">';
	htmlCampo+='<option value="0">Não</option>';
	htmlCampo+='<option value="1">Sim</option>';
	htmlCampo+='</select></td>';
	htmlCampo+='<td><input name="variavel[]"  required  class="form-control" placeholder="Informe o valor" type="text"></td>';
	htmlCampo+='<input type="hidden" value="0" name="todosOsIdsCampos[]" />';
	htmlCampo+='</tr>';
	$(htmlCampo).appendTo('#tabela-campos tbody');
	
	i++;
	
});

//Função de remover campos 
$('a#revCampoForm').click(function(){
	
	 if($('#tabela-campos tbody tr:last').hasClass( "permanente" )){
		 
	 }else{
		 
		 $('#tabela-campos tbody tr:last').remove();
	 }
	 
	 i--;
});



 //Fazer o select
  $( "#selectSetor" ).change(function() {
 	//ID
	id = $( this ).val();
	
	if(0 != id){
		  
			$.ajax({
			  type: "GET",
			  url: "listas/form/"+id
			}).done(function( html ) {  
				$( "#formRequisitante #setor" ).html( html ); 
			});//$.ajax
			   
	}//fim if
	
 });//#selectSetor
 
 
});// Fim document

  
  function chamarSubForm(idForm){
	  
	  //Adicionar uma div dentro da subform
	 // if($( "#formRequisitante #setor #subForm" ).html() != ""){
	/////	 $( "#formRequisitante #setor" ).html("<div id='subForm' >Add o id subForm</div>")
	///  }else{
	///	  $( "#formRequisitante #setor" ).html("<div id='subForm' >Add o id subForm</div>")
	//  }
	  
	  if(!isNaN(idForm)){
		  
	   $.ajax({
			  type: "GET",
			  url: "listas/subform/"+idForm
			}).done(function( html ) {  
				$( "#formRequisitante #setor " ).append( html ); 
			});//$.ajax
	  }else{
		  $( "#formRequisitante #setor " ).append( "" );
	  }
	  
	  
	  
 }
 
