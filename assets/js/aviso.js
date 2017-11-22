$(document).ready(function(){

	var idVendedor = $("#userInfo").attr('idvendedor');

	// INICIA SEQUENCIA DE VERIFICAÇÃO E AVISOS
	// setInterval(function(){
	// 	var d = new Date();
	// 	var minuto = strPad( d.getMinutes(), 2, 0 );
	// 	var hora = strPad( d.getHours(), 2, 0 );
	// 	var horaBusca = hora+':'+minuto;
	

	// 	// console.log('teste execute');

	// 	$.ajax({
	//         url: "ajax/agendaAvisoAjax.php", //URL de destino
	//         data : {'idVendedor': idVendedor, 'horaBusca': horaBusca }, // OQ TA SENDO PASSADO POR GET
	//         dataType: "json", //Tipo de Retorno
	//         success: function(data)
	//         { 
	//         	// console.log(data);
	//         	// console.log('ajax execute');

	//         	if(data.erro != 1){

	//         		$(".close").click();

	// 	        	var dataFull = data.age_data_aviso.split('-');
	// 	        	dataFull = dataFull[2]+"/"+dataFull[1]+"/"+dataFull[0]+" às "+data.age_hora_aviso;

	// 	        	$("#tituloClienteAviso").html(data.cli_nome);
	// 	        	$("#tituloClienteAviso").attr('idAviso', data.age_id);
	// 	        	$("#dataAgendamento").html(dataFull);

	// 	        	var link = "atendimento.php?idCliente="+data.cli_id+"&nmCliente="+data.cli_nome;

	// 	        	$("#linkAtendimento").attr('href', link);
	// 	        	$(".ativaAviso").click();
	// 	        }else{
	// 	        	// console.log('Nenhum aviso encontrado');
	// 	        }
	//         },
	//         erro: function(){
	//         	alert('Houve algum erro nos avisos atualize a pagina !');
	//         }
	//     });

	// }, 10000);

	function strPad(input, length, string) {
	    string = string || '0'; input = input + '';
	    return input.length >= length ? input : new Array(length - input.length + 1).join(string) + input;
	}


	$("#ligarDepois").click(function(){

		var idAviso = $("#tituloClienteAviso").attr('idAviso');

			$.ajax({
		        url: "ajax/agendaAtualizaAjax.php", //URL de destino
		        data : {'idAviso': idAviso }, // OQ TA SENDO PASSADO POR GET
		        // dataType: "json", //Tipo de Retorno
		        success: function(data)
		        { 
		        	// console.log(data);
		        	if(data == 1){
		        		$(".closeModalAviso").click();
		        	}
		        }
		    });

	});


});