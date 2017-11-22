$(document).ready(function(){

	var vendedorInicial = $("#userInfo").attr('idVendedor');
    var actionInit = 'listagemFull';

    // $.ajax({
    //     url: "ajax/clienteFilterAjax.php", //URL de destino
    //     data : {'vendedorInicial': vendedorInicial, 'action': actionInit }, // OQ TA SENDO PASSADO POR GET
    //     success: function(data)
    //     { 
    //     	$(".listagemCliente").html(data);
    //     	console.log(data);
    //     }
    // });
	var action = "buscaFiltro";
	var userProfile = $("#userInfo").attr('userProfile');
	
    $.ajax({
        url: "ajax/clienteFilterAjax.php", //URL de destino
        data : {'vendedorInicial': vendedorInicial, 'nomeFilter': '', 'statusFilter': '', 'estadoFilter': '', 'action': action, 'userProfile': userProfile }, // OQ TA SENDO PASSADO POR GET
        success: function(data)
        {
        	$(".listagemCliente").html(data);
        	// console.log(data);
        }
    });

	// $(".listagemCliente").click(function(){
	// });

	// 	BUSCA HISTÓRICO CLIENTE
	$( "body" ).delegate( ".linhaCliente", "click", function() {
		// $(".linhaCliente").click(function(){
		var idCliente = $(this).attr('idCliente');
		var action = "listagemHistorico";

		$(".linhaCliente").css('background','none');

		var nomeCloente = $(this).find('td').eq(0).text();

		$("#nomeClienteHistorico").html(nomeCloente);
		$("#nomeClienteHistorico").attr("idCliente", idCliente);

        $.ajax({
            url: "ajax/historicoAjax.php", //URL de destino
            data : {'idCliente': idCliente, 'action': action }, // OQ TA SENDO PASSADO POR GET
            success: function(data)
            { 
            	// console.log(data);
            	$("#listagemFeedback").html(data);

            	var distanceTop = $(".ClienteLista"+idCliente).offset().top;
				var distanceDiv = $("#listagemCLientes").offset().top;
				distanceTop =  distanceTop - distanceDiv;
				// console.log(distanceTop);
				$(".widget-box").attr("style", "position:absolute; top:"+distanceTop+"px;");
            }
        });

        $(this).css("background","#438eb9");
	});

	// BUSCA INFORMAÇÕES DO CLIENTE
	$( "body" ).delegate( ".atendimentoCliente", "click", function() {
	// $(".atendimentoCliente").click(function(){

		$(".linhaFeedBack").removeClass('hide');

		var idCliente = $(this).attr('idCliente');
		var action = "buscaInfoCLiente";

        $.ajax({
            url: "ajax/clienteAjaxExtra.php", //URL de destino
            data : {'idCliente': idCliente, 'action': action }, // OQ TA SENDO PASSADO POR GET
            dataType: "json", //Tipo de Retorno
            success: function(data)
            {

            	console.log(data);

				var nomeCliente = $(".ClienteLista"+idCliente).find('td').eq(0).text();
				var tituloStatus = $(".ClienteLista"+idCliente+" td").eq(2).find('a').attr('title');

				var body = '<div class="row text-center linhaStatus"><b><h3>'+data.sta_referencia+' - '+tituloStatus+'</h2></b></div><div class="hr hr-16 hr-dotted"></div><div class="row" style="margin-bottom:10px;"><div class="col-sm-6"><i class="fa fa-user"> Contato: <b>'+data.cli_nome_contato+'</b></i><br><i class="fa fa-building"> Quantidade Imóveis: <b>'+data.cli_quantidade_imoveis+'</b></i><br><i class="fa fa-envelope"> Email: <b>'+data.cli_email+'</b></i></div><div class="col-sm-6"><i class="fa fa-phone"> Tel-1: '+data.cli_telefone+'</i><br><i class="fa fa-phone"> Tel-2: '+data.cli_telefone2+'</i><br><i class="fa fa-internet-explorer"><a href="http://'+data.cli_site+'" target="_blank"> '+data.cli_site+'</a></i></div></div>';

				$("#tituloNomeCliente").text(nomeCliente);
				$("#tituloNomeCliente").attr('idCliente', data.cli_id);
    			$(".dadosCliente").html(body);
    			$(".modalTeste").click();
            }
        });
	});

	// ABRE O FORM PARA ALTERAÇÃO DOS STATUS
	$(".changeStatus").click(function(){

		$(".linhaStatus").addClass('hide');
		$(".statusActive").addClass("hide");

        $.ajax({
            url: "ajax/statusAjax.php", //URL de destino
            success: function(data)
            { 
            	$(".selectStatus").removeClass("hide");	
            }
        });
	});

	// DEFINE O SEGUNDO SUBSTATUS
	$("#status").change(function(){

		var status = $(this).val();

        $.ajax({
            url: "ajax/statusAjax.php", //URL de destino
            data : {'status': status }, // OQ TA SENDO PASSADO POR GET
            success: function(data)
            { 
            	$("#substatus").parent().removeClass("hide");
            	$("#substatus").html(data);
            	$("#salvaStatus").removeClass('hide');
            	$("#cancelaStatus").removeClass('hide');
            }
        });
	});

	// ATUALIZA O STATUS DO CLIENTE
	$("#salvaStatus").click(function(){
		// $(".selectStatus").addClass("hide");
		var idCliente = $("#tituloNomeCliente").attr('idCliente');
		var newStatus = $("#substatus").val();
		var idVendedor = $("#userInfo").attr('idVendedor');

		var action = "atualizaStatus";

        $.ajax({
            url: "ajax/buscaStatusClienteAjax.php", //URL de destino
            data : {'idCliente': idCliente, 'newStatus': newStatus, 'idVendedor': idVendedor }, // OQ TA SENDO PASSADO POR GET
            success: function(data)
            {
            	// console.log(data);
            	$("#instantSearch").keyup();
            	$(".selectStatus").addClass("hide");

				$(".linhaStatus").removeClass('hide');
				$(".statusActive").removeClass("hide");

				$(".linhaCliente[idCliente="+idCliente+"]").click();
				$(".selectStatus").addClass("hide");
	    		$(".textoAviso").html('Status alterado com sucesso');
	    		$(".aviso").removeClass('hide');

				$(".linhaFeedBack").addClass('hide');
				
				setTimeout(function(){
				  $(".aviso").addClass('hide');
				}, 4000);

				$(".close").click();
            }
        });

	});

	// CANCELA A ATUALIZAÇÃO DO STATUS DO CLIENTE
	$("#cancelaStatus").click(function(){
		$(".selectStatus").addClass("hide");
		$(".linhaStatus").removeClass('hide');
		$(".statusActive").removeClass("hide");
	});

	// ABRE O FORM PARA REGISTRO DE AGENDAMENTO DE LIGAÇÃO
	$(".agendarAtendimento").click(function(){
	});

	// SAVA O FEED DIGITADO NO CAMPO DE ATENDIMENTO
	$(".salvaFeed").click(function(){

		var feedContent = $("#feedbackContent").val();
		var idVendedor = $("#userInfo").attr('idVendedor');
		var idCliente = $("#tituloNomeCliente").attr('idCliente');
		var action = "registraHistorico";
		var statusFeed = '';

		if( $(".statusTentativa:checked").length > 0 ){
			// console.log('Esta selecionado o');

			if ( $(".statusTentativa:checked").val() == 1 ){
				statusFeed = 'S';
				// console.log('SIM');
			}else{
				statusFeed = 'N';
				// console.log('NÃO');
			}
		}else{
			// console.log('Não esta selecionado')
			$('.destaqueAviso').css({ "border": "2px solid red", "padding": "5px" });
			$(".textoAviso").html('Você deve selecionar se conseguiu falar com o decisor ou não');
	  		$(".aviso").removeClass('hide');
			setTimeout(function(){
			    $(".aviso").addClass('hide');
				$('.destaqueAviso').removeAttr('style');
			}, 4000);
			// return false;
		}

		if(feedContent != '' && statusFeed != ''){
	        $.ajax({
	            url: "ajax/historicoAjax.php", //URL de destino
	            data : {'idCliente': idCliente, 'action': action, 'idVendedor': idVendedor , 'feedContent': feedContent, 'statusFeed': statusFeed }, // OQ TA SENDO PASSADO POR GET
	            success: function(data)
	            { 
					$("#feedbackContent").val('');
	            	
	            	if(data == 1)
	            	{
	            		$(".textoAviso").html('FeedBack registrado com sucesso');
	            		$(".aviso").removeClass('hide');
	            		$(".linhaCliente[idCliente="+idCliente+"]").click();

						$(".linhaFeedBack").addClass('hide');
						setTimeout(function(){
						  $(".aviso").addClass('hide');
						}, 4000);
	            	}else{
	            		// alert('Houve um problema para inserir o feed tente novamente');
	            		$(".textoAviso").html('Houve um problema para inserir o feed tente novamente');
	            		$(".aviso").removeClass('hide');
	            	}
	            }
	        });
	    }else{
	    	$(".textoAviso").html('Você não pode registrar um FeedBack vazio');
	        $(".aviso").removeClass('hide');
			setTimeout(function(){
			  $(".aviso").addClass('hide');
			}, 4000);
	    }
	});

	$("#novoAgendamento").click(function(){
		$(".formAgendamento").removeClass("hide");
	});

	// SALVA OS AGENDAMENTOS FUTUROS
	$("#salvaAgendamento").click(function(){

		var minuto = $("#minuto").val();
		var hora = $("#hora").val();

		var data = $(".dataAgendamento").val();
		var avisoHora = hora+":"+minuto;

		var idVendedor = $("#userInfo").attr('idVendedor');
		var idCliente = $("#tituloNomeCliente").attr('idCliente');

		// $idVendedor,$idCliente,$titulo,$data, $hora
		data = data.split('-');

		var fullData = data[2]+'-'+data[1]+'-'+data[0];

		// console.log(fullData);
        
        $.ajax({
            url: "ajax/agendaAjax.php", //URL de destino
            data : {'idCliente': idCliente, 'idVendedor': idVendedor, 'avisoHora': avisoHora, 'data': fullData    }, // OQ TA SENDO PASSADO POR GET
            success: function(data)
            { 
            	if(data == 1)
            	{
            		$(".textoAviso").html('Agendamento registrado com sucesso');
            		$(".aviso").removeClass('hide');
            		$(".formAgendamento").addClass('hide');
            		
           			setTimeout(function(){
					  $(".aviso").fadeOut('slow');
					}, 4000);
            	}
            }
        });

		// console.log(data+" "+avisoHora);
	});

	// FAZ A BUSCA DE ACORDO COM OQUE FOR DIGITADO INSTANTANEAMENTE
	$("#instantSearch").keyup(function(){

		var vendedorInicial = $("#userInfo").attr('idVendedor');
		var userProfile = $("#userInfo").attr('userProfile');
		var nomeFilter = $(this).val();
		var statusFilter = $("#statusFilter").val();
		var estadoFilter = $("#estadoFilter").val();
		var action = 'buscaFiltro';

	    $.ajax({
	        url: "ajax/clienteFilterAjax.php", //URL de destino
	        data : {'vendedorInicial': vendedorInicial, 'nomeFilter': nomeFilter, 'statusFilter': statusFilter, 'estadoFilter': estadoFilter, 'action': action, 'userProfile': userProfile }, // OQ TA SENDO PASSADO POR GET
	        success: function(data)
	        {
	        	$(".listagemCliente").html(data);
	        	// console.log(data);
	        }
	    });
	});

	$("#statusFilter").change(function(){
		$("#instantSearch").keyup();
	});

	$("#estadoFilter").change(function(){
		$("#instantSearch").keyup();
	});

	$(".historicoFilter").click(function(){

		var dataDe = $("#dataDe").val();
		var dataAte = $("#dataAte").val();
		var action = "listagemHistorico";

		var idCliente = $("#nomeClienteHistorico").attr("idCliente");

		if(idCliente){	
			$.ajax({
	            url: "ajax/historicoAjax.php", //URL de destino
	            data : {'idCliente': idCliente, 'action': action , 'dataDe': dataDe , 'dataAte': dataAte }, // OQ TA SENDO PASSADO POR GET
	            success: function(data)
	            { 
	            	$("#listagemFeedback").html(data);
	            	// console.log(data);
	            }
	        });
		}


	});

	$( "body" ).delegate( ".refCms", "click", function() {
		if( $('.refCms').find('input').length == 0 ){
			$(this).append('<input type="text"><button class="btn btn-xs btn-success addBondCms">OK</button>');
		}
	});

	$( "body" ).delegate( ".addBondCms", "click", function(){
		// console.log($(this).prev().val());
	});

	// var topo = $("this").position().top;
});