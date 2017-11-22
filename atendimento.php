<?php include ("includes/header.php"); ?>

			<div class="main-content" id="atendimento">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<li class="active">Tela de atendimento</li>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">


						<div class="page-header">
							<h1>
								Listagem de clientes
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<?php require("class/class.status.php");  ?>
							<div class="form-group">
								<div class="col-sm-3">
									<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Nome do Cliente </label>
									<input type="text"  placeholder="Cliente" class="col-xs-10 col-sm-12" name="nomeCliente" id="instantSearch" />
								</div>

								<div class="col-sm-4">
									<label class="col-sm-12 control-label text-left no-margin" for="form-field-1" >Status</label>

									<select class="col-sm-12" id="statusFilter"/>
												<option value="0">Indiferente</option>
										<?php 

											$status = new Status();
											$resultStatus = $status->listaStatus(); 

											foreach ($resultStatus as $key => $value) {

											?>
												<option value="<?=$value['sta_id']?>"><?=$value['sta_referencia']?> - <?=utf8_encode($value['sta_nome'])?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-4">
									<label class="col-sm-12 control-label text-left no-margin" for="form-field-1" >Estado</label>

									<select class="col-sm-12" id="estadoFilter"/>
											<option value="0">Indiferente</option>
											 <option value="AC">Acre</option>
											 <option value="AL">Alagoas</option>
											 <option value="AP">Amapá</option>
											 <option value="AM">Amazonas</option>
											 <option value="BA">Bahia</option>
											 <option value="CE">Ceará</option>
											 <option value="DF">Distrito Federal</option>
											 <option value="GO">Goiás</option>
											 <option value="ES">Espírito Santo</option>
											 <option value="MA">Maranhão</option>
											 <option value="MT">Mato Grosso</option>
											 <option value="MS">Mato Grosso do Sul</option>
											 <option value="MG">Minas Gerais</option>
											 <option value="PA">Pará</option>
											 <option value="PB">Paraiba</option>
											 <option value="PR">Paraná</option>
											 <option value="PE">Pernambuco</option>
											 <option value="PI">Piauí­</option>
											 <option value="RJ">Rio de Janeiro</option>
											 <option value="RN">Rio Grande do Norte</option>
											 <option value="RS">Rio Grande do Sul</option>
											 <option value="RO">Rondônia</option>
											 <option value="RR">Roraima</option>
											 <option value="SP">São Paulo</option>
											 <option value="SC">Santa Catarina</option>
											 <option value="SE">Sergipe</option>
											 <option value="TO">Tocantins</option>
									</select>	
									
								</div>

							</div>
						</div>

							<div class="hr hr-16 hr-dotted"></div>
						<div class="row">
							<div class="col-xs-8" id="listagemCLientes">
								<div class="col-xs-12">
									<table id="simple-table" class="listagemClientes table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Cliente</th>
												<th class="hidden-480">Quantidade de Imóveis</th>
												<th class="hidden-480">Status</th>
												<th class="hidden-480">opções</th>
											</tr>
										</thead>

										<tbody class="listagemCliente">
											
											<tr>
												<td colspan="4" style="color:red; text-align:center;">Selecione um dos itens do filtros para exibir os clientes</td>
											</tr>


										</tbody>
									</table>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="widget-box">
									<div class="widget-header">
										<h4 class="widget-title lighter smaller">
											<i class="ace-icon fa fa-comment blue"></i>
											Historico de: <b id="nomeClienteHistorico"></b>
										</h4>
									</div>

									<div class="widget-body">
										<div class="widget-main no-padding">
											<div class="dialogs" >
												<div class="row filtroHistorico">

														<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> De: </label>
														<div class="col-sm-4">
															<div class="input-group">
																<input id="dataDe" type="text" style="width:100%"/>
															</div>
														</div>

														<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Até: </label>					
														<div class="col-sm-4">
															<div class="input-group">
																<input id="dataAte" type="text" style="width:100%" />
															</div>
														</div>
														
														<div class="col-sm-2">
															<i class="fa fa-search iconSearch historicoFilter"></i>	
														</div>										

												</div>

												<div id="listagemFeedback" style="height:500px; overflow: scroll; overflow-x: hidden;">														
													<i class="fa fa-exchange iconeEmptyHistory"></i>
													<p class="piconeEmptyHistory">Selecione um cliente para vizualizar o histórico</p>
												</div>
											</div>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.widget-box -->
							</div>
						</div>
			</div><!-- /.main-content -->


			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<a href="#my-modal" data-toggle="modal" class="modalTeste"></a>

		<div id="my-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">
							 Cliente: <i class="fa fa-building-o"> <b id="tituloNomeCliente" >Imobiliaária Fulano de tal</b></i>
						</h3>
					</div>

					


					<div class="modal-body">
						<div class="row selectStatus hide" style="margin-bottom:20px;">


							<?php

							foreach ($resultStatus as $key => $value) {
								$statusSelectValues[$value['sta_status']][] = $value['sta_referencia'];
							}


							?>

							<div class="row">
								<div class="col-sm-2">
				 					<label for="" style="width:100px;">Status
				 						<select style="width:60px;" maxlength="150" id="status" name="estado"/>';
										
										<option value=""></option>

									<?php foreach ($statusSelectValues as $key => $value) { ?>

										<option value="<?=$key;?>"><?=$key;?></option>

									<?php } ?>

										</select>
									</label>
								</div>
								<div class="col-sm-10">
									<label for="" style="width:100px;" class="hide">Sub-Status
								 		<select style="width:380px;" maxlength="150" id="substatus" name="estado" />
								 	 	</select>
								  	</label>
								</div>
							</div>
							<br>
							<div class="row text-center">
							 	<div class="col-sm-6">
							 		<button type="button" class="btn btn-success hide" id="salvaStatus" type="button">
							 			<i class="ace-icon fa fa-check bigger-110"></i>
							 			Salvar Status
							 		</button>
							 	</div>
							 	<div class="col-sm-6">
							 		<button type="button" class="btn btn-info hide" id="cancelaStatus" type="button">
							 			<i class="ace-icon fa fa-check bigger-110"></i>
							 			Cancelar
							 		</button>
							 	</div>
							</div>

<!-- 						echo "<pre>";
						print_r($statusSelectValues);
						echo "</pre>"; -->

						</div>
					
						<div class="row hide aviso text-center">
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>
								<strong class="textoAviso">Heads up!</strong>
							</div>

						</div>

						<div class="row text-center statusActive">
							<i class="fa fa-pencil changeStatus"> Alterar status do cliente</b></i>
						</div>

						<div class="row dadosCliente"></div>

						<div class="hr hr-16 hr-dotted"></div>

						<div class="row linhaFeedBack">
							<div class="col-sm-8">
								<label for="">Digite o feedback do atendimento</label>
								<textarea name="feedback" style=" display:block;width:100%;" class="col-sm-6" id="feedbackContent" maxlength="500"></textarea>	
							</div>
							<div class="col-sm-4 destaqueAviso">
								<p><b>Conseguiu falar com o decisor?</b></p>
								<label for="tentativaSim">
									<input type="radio" name="tentantiva" class="statusTentativa" id="tentativaSim" value="1">
									Sim
								</label>
								<div class="clear"></div>
								<label for="tentativaNao">
									<input type="radio" name="tentantiva" class="statusTentativa" id="tentativaNao" value="0">
									Nao
								</label>
								
								<button class="btn btn-sm btn-success salvaFeed" style="margin-top:35px;">
									<i class="ace-icon fa fa-times"></i>
									Salvar FeedBack
								</button>
							</div>	
						</div>

						<div class="row text-center">
							<div class="col-sm-12 agendarAtendimento" style="margin-top:20px;">
								<i class="fa fa-calendar-o" id="novoAgendamento"> Clique para agendar uma nova ligação</i>
							</div>
						</div>

						<br><br>
						<div class="row formAgendamento hide">
							<div class="col-sm-6" >
								<!-- <input type="text" id="datepicker" class="form-control hasDatepicker"> -->
								<input type="text" id="datepicker" class="col-sm-12 dataAgendamento">
								<span class="input-group-addon">
									<i class="ace-icon fa fa-calendar"></i>
								</span>
							</div>
							<div class="col-sm-6" >
								<!-- <input type="text" id="datepicker" class="form-control hasDatepicker"> -->
								<label for="">Hora</label>
								<select maxlength="150" id="hora">
									<?php for ($i=8; $i < 21; $i++) { ?>
									<option value="<?=str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
									<?php } ?>
								</select>
								<label for="">Minuto</label>
								<select maxlength="150" id="minuto">
									<?php for ($i=0; $i < 60; $i++) { ?>
									<option value="<?=str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
									<?php } ?>
								</select>
								<span class="input-group-addon">
									<i class="ace-icon fa fa-clock-o"></i>
								</span>
							</div>

							<div class="col-sm-12 text-center">
								<button class="btn btn-sm btn-success" id="salvaAgendamento" style="margin-top:35px;">
									<i class="ace-icon fa fa-times"></i>
									Agendar
								</button>
							</div>	

						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>


<!-- 		<div id="bannerPostIt" style="display: block; position: absolute; top: 50px; bottom: 0; left: 0; right: 0; margin: auto; text-align: center; width: 395px; height: 396px; background: url(assets/images/postit2.png);">		
			<p style="    display: block;
    float: right;
    font-size: 30px;
    margin-right: 50px;
    cursor: pointer;
    margin-top: 15px;
    padding-top: 33px;" id="fechaposti">X</p> -->


		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>

		<script>
			$("#fechaposti").click(function(){
				$("#bannerPostIt").remove();
			});
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery.1.11.1.min.js"></script>
		<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<script>
            $( "#datepicker" ).datepicker({
                dateFormat: "dd-mm-yy"
            });

            $( "#dataDe" ).datepicker({
                dateFormat: "dd-mm-yy"
            });

            $( "#dataAte" ).datepicker({
                dateFormat: "dd-mm-yy"
            });
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/jquery.jqGrid.min.js"></script>
		<script src="assets/js/grid.locale-en.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets//js/atendimentoScript.js"></script>

		<?php if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){ ?>
		<script>
			$(".linhaFeedBack").removeClass('hide');

			var idCliente = <?=$_GET['idCliente']?>;
			var nmCliente = "<?=$_GET['nmCliente']?>";

			var action = "buscaInfoCLiente";

			// PASSAR TB NOME DO VENDEDOR

	        $.ajax({
	            url: "ajax/clienteAjax.php", //URL de destino
	            data : {'idCliente': idCliente, 'action': action }, // OQ TA SENDO PASSADO POR GET
	            dataType: "json", //Tipo de Retorno
	            success: function(data)
	            {
					var body = '<div class="row text-center linhaStatus"><b><h3>'+data.sta_referencia+' - '+data.sta_nome+'</h2></b></div><div class="hr hr-16 hr-dotted"></div><div class="row" style="margin-bottom:10px;"><div class="col-sm-6"><i class="fa fa-user"> Contato: <b>'+data.cli_nome_contato+'</b></i><br><i class="fa fa-building"> Quantidade Imóveis: <b>'+data.cli_quantidade_imoveis+'</b></i><br><i class="fa fa-envelope"> Email: <b>'+data.cli_email+'</b></i></div><div class="col-sm-6"><i class="fa fa-phone"> Tel-1: '+data.cli_telefone+'</i><br><i class="fa fa-phone"> Tel-2: '+data.cli_telefone2+'</i><br><i class="fa fa-internet-explorer"><a href="http://'+data.cli_site+'" target="_blank"> '+data.cli_site+'</a></i></div></div>';

					console.log(data);

					$("#tituloNomeCliente").text(nmCliente);

					$("#tituloNomeCliente").attr('idCliente', data.cli_id);
	    			$(".dadosCliente").html(body);
	    			$(".modalTeste").click();
	            }
	        });
		</script>
		<?php } ?>

		<?php  include('modalAviso.php'); ?>

	</body>
</html>
