<?php include ("includes/header.php"); ?>

			<div class="main-content" id="atribuicoes">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
								<i class="ace-icon fa fa-home home-icon"></i>
							<li class="active">Atribuições do Gestor</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">


						<div class="page-header">
							<h1>Lista de atribuições de gestores </h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form">


									<div class="space-6"></div>

									<div class="form-group">
										<!-- <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="food"> </label> -->

										<div class="col-xs-12 col-sm-12 text-center">
											<select style="width:200px;" id="selectGestor" maxlength="150" name="estado">
												 <option value="">Selecione um Gestor</option>

												<?php require("class/class.user.php");  

													$usuarios = new User();
													$result = $usuarios->listaUser(5);

													foreach ($result as $key => $value) { ?>
														
														<option value="<?=$value['id']?>"><?=$value['nome']?></option>

													<?php } ?>
												
											</select>
												 <button type="button" id="buscaClientes" class="btn btn-failed" type="button">
													Buscar
												</button>
											<!-- <h4 class="nomeVendedor hide"></h4> -->
										</div>
									</div>

									<div class="hr hr-16 hr-dotted"></div>

									<div class="form-group camposSelectPrincipal hide">
										<!-- <label class="col-sm-3 control-label no-padding-top" for="duallist"> Listagem de clientes </label> -->

										<div class="col-sm-5">
											<label for="" class="col-sm-12">Vendedores sem gestor</label>
											<div class="col_sm-12" style="margin-bottom:1px;">
												<input type="text" class="inputChange" placeholder="Digite o nome" id="nameLikeLivre">
											</div>
											<select multiple="multiple" size="10" id="clientesLivres" class="masterSelect" style="width:100%; height:268px;">
											</select>
										</div>

										<div class="col-sm-2">
										<br><br><br><br><br>
											<div class="row text-center botaoSalvaAtrib">
												<button type="button" class="btn btn-success" id="adicionaCliente" type="button">
													Adicionar >>
												</button>
												<br><br>
											</div>
											
											<div class="hr hr-16 hr-dotted"></div>

											<div class="row text-center botaoSalvaAtrib">
												<button type="button" class="btn btn-failed" id="removeCliente" type="button">
													<< Remover
												</button>
												<br><br>
											</div>
										</div>
										
										<div class="col-sm-5">
											<label for="" class="col-sm-12">Vendedores do Gestor</label>
											<div class="col_sm-12" style="margin-bottom:1px;">
												<input type="text" class="inputChange" placeholder="Digite o nome" id="nameLikeVendedor">
											</div>
											<select multiple="multiple" size="10" class="masterSelect" id="clientesUsuario" style="width:100%; height:268px;">
											</select>
										</div>
									</div>
								</form>

							</div><!-- /.col -->
						</div><!-- /.row -->

						<div class="hr hr-16 hr-dotted"></div>


					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
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
		<script src="assets/js/jquery.bootstrap-duallistbox.min.js"></script>
		<script src="assets/js/jquery.raty.min.js"></script>
		<script src="assets/js/bootstrap-multiselect.min.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script src="assets/js/typeahead.jquery.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- SCRIPT EXTRA -->
		<script src="assets/js/atribuicoesGestorScript.js"></script>

		<!-- inline scripts related to this page -->

		</script>
		
		<?php  include('modalAviso.php'); ?>

	</body>
</html>
