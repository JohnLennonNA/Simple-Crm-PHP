$(document).ready(function(){


	// BUSCA INFORMAÇÕES PELO CEP
	$("#cep").blur(function(){

		var cep = $(this).val();

		if(cep.length == 9){

			cep = cep.replace("-", '');

	        $.ajax({
	            url: "ajax/cepAjax.php", //URL de destino
	            data : {'cep': cep }, // OQ TA SENDO PASSADO POR GET
	            dataType: "json", //Tipo de Retorno
	            success: function(data)
	            { 
	            	console.log(data);

	            	$("#endereco").val(data.logradouro);
	            	$("#cidade").val(data.localidade);
	            	$("#bairro").val(data.bairro);
	            	$("#estado").val(data.uf);
	            }
	        });
		}
	});


	$("#nomeCliente").blur(function(){

		$(".listaIstantSearch").addClass("hide");
	});
	
	$("#nomeCliente").keyup(function(){

		var nome = $(this).val();
		var action = 'listaAll';

		if(nome != '')
		{
		    $.ajax({
		        url: "ajax/clienteAllAjax.php", //URL de destino
		        data : {'nome': nome, 'action': action }, // OQ TA SENDO PASSADO POR GET
		        success: function(data)
		        { 
		        	if(data != '')
		        	{
		        		$(".listaIstantSearch").html(data);
		        		$(".listaIstantSearch").removeClass("hide");
		        	}
		        	else{
						$(".listaIstantSearch").addClass("hide");
		        	}
		        	console.log(data);
		        }
		    });
		}
		else{
			$(".listaIstantSearch").addClass("hide");
		}
	});


	$(".phone").blur(function(){

		var phone = $(this).val();
		var action = 'verifPhone';

		var idNotSearch = $("#idCliente").val();

		console.log(idNotSearch);


		var elemento = $(this);

		if(phone != '')
		{
		    $.ajax({
		        url: "ajax/clienteAllAjax.php", //URL de destino
		        data : {'phone': phone, 'action': action, 'idNotSearch': idNotSearch  },
		        success: function(data)
		        { 
		        	
		        	// console.log(data);

		        	if(data != 0 ){
		        		$(elemento).parent().next().find('.avisoPhone').removeClass('hide');
		        		var texto = $(elemento).parent().next().find('.avisoPhone').text();
						$(elemento).parent().next().find('.avisoPhone').text(texto+" -> "+data);
						
						$(".cadastraCliente").prop("disabled",true);
		        		// console.log(data);
		        		// alert('funfo');
		        	}else{
		        		$(elemento).parent().next().find('span').addClass('hide');
		        		$(".cadastraCliente").prop("disabled",false);
		        	}
		        	
		        }
		    });
		}
		else{
			$(".listaIstantSearch").addClass("hide");
		}
	});



	$("#cadastraCMS").click(function(){

		// alert('redireciona');
		var slugRedirect = '';

		$('input:text').each(function(){
			slugRedirect += $(this).attr('name')+'='+$(this).val()+'&';
		})

		window.location = "/cms/client/new?"+slugRedirect;

	});
});