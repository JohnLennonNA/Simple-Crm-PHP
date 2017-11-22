$(document).ready(function(){

	var usuarioAtual;

	$("#buscaClientes").click(function(){
		
		// $('.nomeVendedor').html('Vendedor: '+$(this).find("option:selected").text() ).removeClass('hide');

		// $(this).hide();


		var idVendedor = $('#selectVendedor').val();
		// var idVendedor = 9;
		
		var selectEstado = $("#selectEstado").val();

		console.log(selectEstado);

		var likeName = $("#nameLikeVendedor").val();

	    $.ajax({
	        url: "ajax/clienteListaAjax.php", //URL de destino
	        data : {'idVendedor': idVendedor, 'selectEstado': selectEstado, 'likeName': likeName }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	$("#clientesUsuario").html(data);
	        	// console.log(data);
	        }
	    });

		var likeName = $("#nameLikeLivre").val();

	    $.ajax({
	        url: "ajax/clienteListaAjax.php", //URL de destino
	        data : {'idVendedor': 0, 'selectEstado': selectEstado, 'likeName': likeName }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	$("#clientesLivres").html(data);
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

		varIn = '('+varIn.substring(1)+')';

		// console.log(varIn);

		var idVendedor = $('#selectVendedor').val();
		var profileId = $('#selectVendedor option:selected').attr("profileId");
		var operacao = 'add';

	    $.ajax({
	        url: "ajax/clienteAtualizaAjax.php", //URL de destino
	        data : {'idVendedor': idVendedor, 'varIn': varIn, 'operacao': operacao, 'profileId': profileId  }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	    		$("#buscaClientes").click();
	    		$("#qtdImoveisImobiliarias").click();
	        	// console.log(data);
	        }
	    });
	});


	$("#removeCliente").click(function(){

		var varIn = '';

		$("#clientesUsuario").find('.selected').each(function(){
			varIn += ','+$(this).val();
		});

		varIn = '('+varIn.substring(1)+')';
		// var idVendedor = $('#selectVendedor').val();

	    $.ajax({
	        url: "ajax/clienteAtualizaAjax.php", //URL de destino
	        data : {'idVendedor': 0, 'varIn': varIn }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	// $("#clientesUsuario").html(data);
        		$("#buscaClientes").click();
        		$("#qtdImoveisImobiliarias").click();
	        	// console.log(data);
	        }
	    });
	});


	$("#transfereCliente").click(function(){

		var varIn = '';

		$("#clientesUsuario").find('.selected').each(function(){
			varIn += ','+$(this).val();
		});

		varIn = '('+varIn.substring(1)+')';
		var idVendedor = $('#selectVendedorTrasnf').val();
		var profileId = $('#selectVendedorTrasnf option:selected').attr("profileId");

	    $.ajax({
	        url: "ajax/clienteAtualizaAjax.php", //URL de destino
	        data : {'idVendedor': idVendedor, 'varIn': varIn, 'operacao': 'transferencia', 'profileId': profileId }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	// $("#clientesUsuario").html(data);
        		$("#buscaClientes").click();
        		$("#qtdImoveisImobiliarias").click();
        		$("#selectVendedorTrasnf").val($("#selectVendedorTrasnf option:first").val());
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


	$("#qtdImoveisImobiliarias").click(function(){

		$.ajax({
	        url: "ajax/relatorioAjax.php", //URL de destino
	        // data : {'idVendedor': 0, 'varIn': varIn }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	// $("#clientesUsuario").html(data);
	        	$("#qtdImoveisImobiliarias").html(data);
	        	// console.log(data);
	        }
	    });

	});

	$(".inputChange").keyup(function(){
		$("#buscaClientes").click();
	});

});