$(document).ready(function(){
	
	$("#bairro").keyup(function(){

		var string = $(this).val();
		var action = 'listaBairro';

		if(string != '')
		{
		    $.ajax({
		        url: "ajax/inputSearchAjax.php", //URL de destino
		        data : {'string': string, 'action': action }, // OQ TA SENDO PASSADO POR GET
		        success: function(data)
		        { 
		        	if(data != '')
		        	{
		        		$('.bairroSearch').html(data);
		        		$('.bairroSearch').removeClass("hide");
		        	}
		        	else{
						$('.bairroSearch').addClass("hide");
		        	}

		        	console.log(data);
		        }
		    });
		}
		else{
			$('.bairroSearch').addClass("hide");
		}
	});



	$("#cidade").keyup(function(){

		var string = $(this).val();
		var action = 'listaCidade';

		if(string != '')
		{
		    $.ajax({
		        url: "ajax/inputSearchAjax.php", //URL de destino
		        data : {'string': string, 'action': action }, // OQ TA SENDO PASSADO POR GET
		        success: function(data)
		        { 
		        	if(data != '')
		        	{
		        		$('.cidadeSearch').html(data);
		        		$('.cidadeSearch').removeClass("hide");
		        	}
		        	else{
						$('.cidadeSearch').addClass("hide");
		        	}

		        	console.log(data);
		        }
		    });
		}
		else{
			$('.cidadeSearch').addClass("hide");
		}
	});


	$("#imobiliaria").keyup(function(){

		var string = $(this).val();
		var action = 'listaImobiliarias';

		if(string != '')
		{
		    $.ajax({
		        url: "ajax/inputSearchAjax.php", //URL de destino
		        data : {'string': string, 'action': action }, // OQ TA SENDO PASSADO POR GET
		        success: function(data)
		        { 
		        	if(data != '')
		        	{
		        		$('.imobiliariaSearch').html(data);
		        		$('.imobiliariaSearch').removeClass("hide");
		        	}
		        	else{
						$('.imobiliariaSearch').addClass("hide");
		        	}

		        	console.log(data);
		        }
		    });
		}
		else{
			$('.imobiliariaSearch').addClass("hide");
		}
	});


	$("#vendedor").keyup(function(){

		var string = $(this).val();
		var action = 'listaVendedores';

		if(string != '')
		{
		    $.ajax({
		        url: "ajax/inputSearchAjax.php", //URL de destino
		        data : {'string': string, 'action': action }, // OQ TA SENDO PASSADO POR GET
		        success: function(data)
		        { 
		        	if(data != '')
		        	{
		        		$('.vendedorSearch').html(data);
		        		$('.vendedorSearch').removeClass("hide");
		        	}
		        	else{
						$('.vendedorSearch').addClass("hide");
		        	}
		        }
		    });
			
			
		}
		else{
			$('.vendedorSearch').addClass("hide");
		}
	});

	// $('.listSearch').click(function(){
	$( "body" ).delegate( ".listSearch", "click", function() {
		// console.log('teste');
		var string = $(this).text();
		var id = $(this).attr('id');
		var ref = $(this).attr('ref');

		$(this).parent().prev().val(string);
		
		$('#'+ref).val(id);
		$(this).parent().addClass("hide");
	});


	$( "body" ).delegate( ".linhaCliente", "click", function() {
		// $(".linhaCliente").click(function(){
			
		if( $(this).find('.listagemFeedback').hasClass('hide') ){

			$(".listagemFeedback").addClass('hide');

			var idCliente = $(this).attr('idCliente');
			var action = "listagemHistorico";

			$(".linhaCliente").css('background','none');

			var nomeCloente = $(this).find('td').eq(0).text();

			$("#nomeClienteHistorico").html(nomeCloente);
			$("#nomeClienteHistorico").attr("idCliente", idCliente);

			var element = $(this).find(".listagemFeedback");

	        $.ajax({
	            url: "ajax/historicoAjax.php", //URL de destino
	            data : {'idCliente': idCliente, 'action': action }, // OQ TA SENDO PASSADO POR GET
	            success: function(data)
	            { 
	            	// console.log(data);
	            	$(element).html('<br>Click no quadro para fechar <br><br>'+data);
	            	$(element).removeClass('hide');
	            }
	        });

	        $(this).css("background","#438eb9");
	    }else{
	    	$(".listagemFeedback").addClass('hide');
			$(".linhaCliente").css('background','none');
	    }
	});


	$("body").delegate(".transfereCliente", "click", function() {
	// $(".transfereCliente").click(function(){

		var varIn = '';
		if( $(this).next().hasClass('hide')){
	    	$(".listagemClientes").addClass("hide");
			$(this).next().removeClass('hide');
	    }else{
	    	$(this).next().addClass('hide');
	    }

	    var element = $(this).next();

	    $.ajax({
	        url: "ajax/vendedoresListaAjax.php", //URL de destino
	        data : {'action': 'vendedoresLivres'}, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
	        	// console.log(data);
        		$(element).html(data);
	        }
	    });

		$(this).next().attr('idCliente', $(this).parent().nextAll(':lt(2)').eq(1).attr('idcliente'));
	});

	$("body").delegate(".listagemClientes option", "click", function() {
		var idCiente = $(this).parent().attr('idcliente');
		var idVendedor = $(this).val();
		
		var profileId = $(this).attr("profileid");

		varIn = ','+idCiente;
		varIn = '('+varIn.substring(1)+')';

		var element = $(this);

	    $.ajax({
	        url: "ajax/clienteAtualizaAjax.php", //URL de destino
	        data : {'idVendedor': idVendedor, 'varIn': varIn , 'operacao': 'add', 'profileId': profileId }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        { 
				$(element).parents().eq(2).find('td').eq(1).text($(element).text());
				$(".listagemClientes").addClass('hide');
	        }
	    });
	});


	$("#cidade").keyup(function(){

		var string = $(this).val();
		var action = 'listaCidade';

		if(string != '')
		{
		    $.ajax({
		        url: "ajax/inputSearchAjax.php", //URL de destino
		        data : {'string': string, 'action': action }, // OQ TA SENDO PASSADO POR GET
		        success: function(data)
		        { 
		        	if(data != '')
		        	{
		        		$('.cidadeSearch').html(data);
		        		$('.cidadeSearch').removeClass("hide");
		        	}
		        	else{
						$('.cidadeSearch').addClass("hide");
		        	}

		        	console.log(data);
		        }
		    });
		}
		else{
			$('.cidadeSearch').addClass("hide");
		}
	});

	$(".fa-sort-amount-asc").click(function(){

		if( $(".geralVendedores").hasClass('hide') ){
			$(".geralVendedores").removeClass('hide');
		}else{
			$(".geralVendedores").addClass('hide');
		}

		

	});



});