<?php include ("includes/header.php");
	  include_once("class/class.status.php");
	  include_once("class/class.relatorios.php");


	  $status = new Status();
	  $relatorio = new Relatorio();

	  $slug = '';

	if (isset($_GET['p']) && $_GET['p'] != ''){
	  	$relatorio->pagina = $_GET['p'];
	}

	if ( ( isset($_GET['dataDe']) && $_GET['dataDe'] != '') && ( isset($_GET['dataAte']) && $_GET['dataAte'] != '') ){
		$relatorio->filtro = 1;
	  	$relatorio->dataDe = $_GET['dataDe'];
	  	$relatorio->dataAte = $_GET['dataAte'];
	  	$slug .= '&dataDe='.$relatorio->dataDe;
	  	$slug .= '&dataAte='.$relatorio->dataAte;
	}

	if ( isset($_GET['uf']) && $_GET['uf'] != '' ){
		$relatorio->filtro = 1;
		$relatorio->uf = $_GET['uf'];
	}

	if ( isset($_GET['cidade'])  && $_GET['cidade'] != '' ){
		$relatorio->filtro = 1;
		$relatorio->cidade = $_GET['cidade'];
	}

	if ( isset($_GET['bairro']) && $_GET['bairro'] != '' ){
		$relatorio->filtro = 1;
		$relatorio->bairro = $_GET['bairro'];
	}

	if ( isset($_GET['idVendedor']) && $_GET['idVendedor'] != '' ){
		$relatorio->filtro = 1;
		$relatorio->idVendedor = $_GET['idVendedor'];
	}

	if ( isset($_GET['idImobiliaria']) && $_GET['idImobiliaria'] != '' ){
		$relatorio->filtro = 1;
		$relatorio->idCliente = $_GET['idImobiliaria'];
	}
	
 ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<span class="menu-text"> Home </span>
							</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<form action="" method="GET">
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> De </label>
										<input id="dataDe" name="dataDe" type="date" style="width:100%" value="<?=$_GET['dataDe']?>" class="form-control" >
									</div>
									<div class="col-sm-2">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Até </label>
										<input id="dataAte" name="dataAte" type="date" style="width:100%;" value="<?=$_GET['dataAte']?>" class="form-control">
									</div>

									<div class="col-sm-3" style="position:relative;">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Bairro </label>
										<input type="text"  placeholder="Bairro" class="col-xs-10 col-sm-12" name="bairro" id="bairro" />
										<div class="listaIstantSearch bairroSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>

									</div>
									<div class="col-sm-3">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Cidade </label>
										<input type="text"  placeholder="Cidade" class="col-xs-10 col-sm-12" id="cidade" name="cidade" />
										<div class="listaIstantSearch cidadeSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>
									</div>

									<div class="col-sm-2">
										<label class="col-sm-12 control-label text-left no-margin" for="form-field-1" >UF</label>

										<select class="col-sm-12" name="uf" id="estadoFilter"/>
												<option value="">Indiferente</option>
												 <option value="AC" <?=( $_GET['uf'] == 'AC'  ) ? 'selected':''?>>AC</option>
												 <option value="AL" <?=( $_GET['uf'] == 'AL'  ) ? 'selected':''?>>AL</option>
												 <option value="AP" <?=( $_GET['uf'] == 'AP'  ) ? 'selected':''?>>AP</option>
												 <option value="AM" <?=( $_GET['uf'] == 'AM'  ) ? 'selected':''?>>AM</option>
												 <option value="BA" <?=( $_GET['uf'] == 'BA'  ) ? 'selected':''?>>BA</option>
												 <option value="CE" <?=( $_GET['uf'] == 'CE'  ) ? 'selected':''?>>CE</option>
												 <option value="DF" <?=( $_GET['uf'] == 'DF'  ) ? 'selected':''?>>DF</option>
												 <option value="GO" <?=( $_GET['uf'] == 'GO'  ) ? 'selected':''?>>GO</option>
												 <option value="ES" <?=( $_GET['uf'] == 'ES'  ) ? 'selected':''?>>ES</option>
												 <option value="MA" <?=( $_GET['uf'] == 'MA'  ) ? 'selected':''?>>MA</option>
												 <option value="MT" <?=( $_GET['uf'] == 'MT'  ) ? 'selected':''?>>MT</option>
												 <option value="MS" <?=( $_GET['uf'] == 'MS'  ) ? 'selected':''?>>MS</option>
												 <option value="MG" <?=( $_GET['uf'] == 'MG'  ) ? 'selected':''?>>MG</option>
												 <option value="PA" <?=( $_GET['uf'] == 'PA'  ) ? 'selected':''?>>PA</option>
												 <option value="PB" <?=( $_GET['uf'] == 'PB'  ) ? 'selected':''?>>PB</option>
												 <option value="PR" <?=( $_GET['uf'] == 'PR'  ) ? 'selected':''?>>PR</option>
												 <option value="PE" <?=( $_GET['uf'] == 'PE'  ) ? 'selected':''?>>PE</option>
												 <option value="PI" <?=( $_GET['uf'] == 'PI'  ) ? 'selected':''?>>PI</option>
												 <option value="RJ" <?=( $_GET['uf'] == 'RJ'  ) ? 'selected':''?>>RJ</option>
												 <option value="RN" <?=( $_GET['uf'] == 'RN'  ) ? 'selected':''?>>RN</option>
												 <option value="RS" <?=( $_GET['uf'] == 'RS'  ) ? 'selected':''?>>RS</option>
												 <option value="RO" <?=( $_GET['uf'] == 'RO'  ) ? 'selected':''?>>RO</option>
												 <option value="RR" <?=( $_GET['uf'] == 'RR'  ) ? 'selected':''?>>RR</option>
												 <option value="SP" <?=( $_GET['uf'] == 'SP'  ) ? 'selected':''?>>SP</option>
												 <option value="SC" <?=( $_GET['uf'] == 'SC'  ) ? 'selected':''?>>SC</option>
												 <option value="SE" <?=( $_GET['uf'] == 'SE'  ) ? 'selected':''?>>SE</option>
												 <option value="TO" <?=( $_GET['uf'] == 'TO'  ) ? 'selected':''?>>TO</option>
										</select>	
										
									</div>

								</div>
							</div>
							<br>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Vendedor </label>
										<input type="text" idVendedor=""  placeholder="Vendedor" class="col-xs-10 col-sm-12" name="vendedor" id="vendedor" />
										<div class="listaIstantSearch vendedorSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Imobiliária </label>
										<input type="text" idImobiliaria="" placeholder="Imobiliária" class="col-xs-10 col-sm-12" name="imobiliaria" id="imobiliaria" />
										<div class="listaIstantSearch imobiliariaSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row text-center">
								<div class="col-sm-12">
									<input type="hidden" name="idVendedor" id="idVendedor">
									<input type="hidden" name="idImobiliaria" id="idImobiliaria">
									<input type="submit" class="btn btn-primary" value="Buscar">
								</div>
							</div>
						</form>

						<div class="hr hr-16 hr-dotted"></div>
						
						<div class="row">
								<!-- PAGE CONTENT BEGINS -->
							<div class="col-sm-6 text-center">
								 <div id="chartCidade" style="width: 500px; height: 500px;"></div>
								 <!-- select count(*), s.sta_nome, s.sta_referencia from clientesFuturos c INNER JOIN statusCliente s ON (c.cli_id_status = s.sta_id ) group by s.sta_referencia -->
							</div>
							<div class="col-sm-6 text-center">
								 <div id="chartBairro" style="width: 500px; height: 500px;"></div>
								 
								 <!-- select count(*), s.sta_nome, s.sta_referencia from clientesFuturos c INNER JOIN statusCliente s ON (c.cli_id_status = s.sta_id ) group by s.sta_referencia -->
							</div>

						</div><!-- /.col -->

						<div class="row">
								<!-- PAGE CONTENT BEGINS -->
							<div class="col-sm-6 text-center">
								 <div id="" style="width: 500px; height: 500px;"></div>
								 <!-- select count(*), s.sta_nome, s.sta_referencia from clientesFuturos c INNER JOIN statusCliente s ON (c.cli_id_status = s.sta_id ) group by s.sta_referencia -->
							</div>
							<div class="col-sm-6 text-center">
								 <div id="" style="width: 500px; height: 500px;"></div>
								 
								 <!-- select count(*), s.sta_nome, s.sta_referencia from clientesFuturos c INNER JOIN statusCliente s ON (c.cli_id_status = s.sta_id ) group by s.sta_referencia -->
							</div>

						</div><!-- /.col -->
						
						<br>

					</div><!-- /.row -->

					</div><!-- /.page-content -->

				</div>
			</div><!-- /.main-content -->
			<!-- PAGE CONTENT ENDS -->	
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
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

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/fuelux.spinner.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/jquery.knob.min.js"></script>
		<script src="assets/js/jquery.autosize.min.js"></script>
		<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/relatorioScript.js"></script>


		<script>
            // $( ".datepicker" ).datepicker({
            //     dateFormat: "mm-dd-yy"
            // });
			$(".datepicker").datepicker("option", "dateFormat", "yy-mm-dd ");
		</script>
		<script type="text/javascript">
		 	  google.load("visualization", "1", {packages:["corechart"]});
		      google.setOnLoadCallback(drawChart);
		      function drawChart() {
		        var data = google.visualization.arrayToDataTable([
		          ['Language', 'Speakers (in millions)'],
		          ['German',  5.85],
		          ['French',  1.66],
		          ['Italian', 0.316],
		          ['Romansh', 0.0791]
		        ]);

		      var options = {
		        legend: 'none',
		        pieSliceText: 'label',
		        title: 'Quantidade de imobiliárias por cidade',
		        pieStartAngle: 100,
		      };

		      var options2 = {
		        legend: 'none',
		        pieSliceText: 'label',
		        title: 'Quantidade de imobiliárias por Bairro',
		        pieStartAngle: 100,
		      };

		        var chartCidade = new google.visualization.PieChart(document.getElementById('chartCidade'));
		        chartCidade.draw(data, options);

		        var chartBairro = new google.visualization.PieChart(document.getElementById('chartBairro'));
		        chartBairro.draw(data, options2);


		      }
		    </script>

		<?php  include('modalAviso.php'); ?>

	</body>
</html>
