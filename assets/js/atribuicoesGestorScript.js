$(document).ready(function(){

	var usuarioAtual;

	$("#buscaClientes").click(function(){

		var action = 'vendedoresLivres';

	    $.ajax({
	        url: "ajax/vendedoresListaAjax.php", //URL de destino
	        data : {'action': action }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	$("#clientesLivres").html(data);
	        	console.log(data);
	        }
	    });

		var action = 'vendedoresGestor';
		var idGestor = $('#selectGestor').val();

	    $.ajax({
	        url: "ajax/vendedoresListaAjax.php", //URL de destino
	        data : {'action': action, 'idGestor': idGestor }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	$("#clientesUsuario").html(data);
	        	// console.log(data);
	        }
	    });

		$(".camposSelectPrincipal").removeClass('hide');
	});

	$("#adicionaCliente").click(function(){

		var varIn = '';

		$("#clientesLivres").find('.selected').each(function(){
			varIn += ','+$(this).val();
		});

		varIn = '['+varIn.substring(1)+']';

		var idGestor = $('#selectGestor').val();

	    $.ajax({
	        url: "ajax/gestorAtualizaAjax.php", //URL de destino
	        data : {'idGestor': idGestor, 'varIn': varIn }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 

	        	console.log(data);
	        	// $("#clientesUsuario").html(data);
	        	// if(data == 1)
	        	// {
	        		$("#buscaClientes").click();
	        	// 	$("#qtdImoveisImobiliarias").click();
	        	// }
	        	// console.log(data);
	        }
	    });
	});


	$("#removeCliente").click(function(){

		var varIn = '';

		$("#clientesUsuario").find('.selected').each(function(){
			varIn += ','+$(this).val();
		});

		varIn = '['+varIn.substring(1)+']';
		var idVendedor = $('#selectGestor').val();

	    $.ajax({
	        url: "ajax/vendedorRemoveAtualizaAjax.php", //URL de destino
	        data : {'idGestor' : idVendedor, 'varIn': varIn }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	// $("#clientesUsuario").html(data);
	        	if(data == 1)
	        	{
	        		$("#buscaClientes").click();
	        		$("#qtdImoveisImobiliarias").click();
	        	}
	        	console.log(data);
	        }
	    });
	});

	$( "body" ).delegate( ".masterSelect option", "click", function(){
		if( $(this).hasClass('selected') )
		{
			$(this).removeClass('selected');
		}else{
			$(this).addClass('selected');
		}
	});


	// $("#qtdImoveisImobiliarias").click(function(){

	// 	$.ajax({
	//         url: "ajax/relatorioAjax.php", //URL de destino
	//         // data : {'idVendedor': 0, 'varIn': varIn }, // OQ TA SENDO PASSADO POR GET
	//         success: function(data)
	//         { 
	//         	// $("#clientesUsuario").html(data);
	//         	$("#qtdImoveisImobiliarias").html(data);
	//         	// console.log(data);
	//         }
	//     });

	// });

	$("#selectGestor").change(function(){
		if($(this).val() != ''){
			$("#buscaClientes").click();
		}
	});

});