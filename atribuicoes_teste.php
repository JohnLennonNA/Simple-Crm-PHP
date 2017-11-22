<?php include ("includes/header.php"); ?>

			<div class="main-content" id="atribuicoes">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
								<i class="ace-icon fa fa-home home-icon"></i>
							<li class="active">Atribuições de Clientes</li>
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


						<div class="page-header">
							<h1>Lista de atribuições </h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form">


									<div class="space-6"></div>

									<div class="form-group">
										<!-- <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="food"> </label> -->

										<div class="col-xs-12 col-sm-12 text-center">
											<select style="width:200px;" id="selectVendedor" maxlength="150" name="estado">
												 <option value="">Selecione um vendedor</option>

												<?php require("class/class.user.php");  

													$usuarios = new User();


												if($_SESSION['_sf2_attributes']['profileUser'] == 5){
													$result = $usuarios->listaUserAtribuicoes($_SESSION['_sf2_attributes']['idUser']);
												}else{
													$result = $usuarios->listaUser(2);
												}	

													// echo "<pre>";
													// print_r($result);
													// echo "</pre>";

													foreach ($result as $key => $value) { ?>
														
														<option value="<?=$value['id']?>"><?=$value['nome']?></option>

												<?php } ?>
												
											</select>
												<select style="width:200px;" maxlength="150" id="selectEstado" name="estado"/>
												<option value="">Selecione ...</option>
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
											<label for="" class="col-sm-12">Clientes sem vendedor</label>
											<div class="col_sm-12" style="margin-bottom:1px;">
												<input type="text" class="inputChange" placeholder="Digite o nome" id="nameLikeLivre">
											</div>
											<select multiple="multiple" size="10" id="clientesLivres" class="masterSelect" style="width:100%; height:268px;">
											</select>
										</div>

										<div class="col-sm-2">
										<br>
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
											
											<div class="hr hr-16 hr-dotted"></div>
											
											<div class="row text-center botaoSalvaAtrib">
												<select style="width:150px;" id="selectVendedorTrasnf" maxlength="150" name="estado">
													<option value="">Selecione um vendedor</option>

													<?php 

														$userTrasnf = new User();

													if($_SESSION['_sf2_attributes']['profileUser'] == 5){
														$result = $userTrasnf->listaUserAtribuicoes($_SESSION['_sf2_attributes']['idUser']);
													}else{
														$result = $userTrasnf->listaUser(2);
													}	

														foreach ($result as $key => $value) { ?>
															
															<option value="<?=$value['id']?>"><?=$value['nome']?></option>

													<?php } ?>
												</select>
												<br><br>

												<button type="button" class="btn btn-primary" id="transfereCliente" type="button">
													> Transferir <
												</button>
											</div>
										</div>
										
										<div class="col-sm-5">
											<label for="" class="col-sm-12">Clientes do vendedor</label>
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

						<div class="row">
							<br>
							<label for="" class="col-sm-12 text-center">Resumo de vendedores por estado</label>
							<br>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class="center">Vendedor</th>

										<th class="center">Total Imobiliárias</th>
										<th class="center">Total Imóveis</th>
									</tr>
								</thead>

								<tbody id="qtdImoveisImobiliarias">
									
									<?php include_once('class/class.relatorios.php');

									$relatorio = new Relatorio();
									$result = $relatorio->qtdImoveisImobiliarias();


									if( count($result) > 0 ){


									foreach ($result as $key => $value){ ?>
										<tr>
											<td><?=$value['nome']?></td>
											<td><?=$value['qtdImobiliarias']?></td>
											<td><?=$value['qtdImoveis']?></td>
										</tr>


									<?php }
									}else{

										echo "<td colspan='3' class='text-center'>Não foi encontrada nenhuma atribuição</td>";

									} ?>

								</tbody>
							</table>
						</div>


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
		<script src="assets/js/atribuicoesScript.js"></script>

		<!-- inline scripts related to this page -->

		</script>
		
		<?php  include('modalAviso.php'); ?>

	</body>
</html>
