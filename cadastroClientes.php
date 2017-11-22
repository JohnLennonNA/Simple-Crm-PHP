<?php
header('Content-Type: text/html; charset=utf-8');

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

// echo "<pre>";
// print_r($_REQUEST);

include("class/class.cliente.php");

	if( isset( $_POST['action'] ) && $_POST['action'] == 'cadastraCliente'){


		$cliente = new Cliente();

		// echo $cliente->cadastraCliente($_POST['nomeCliente'],$_POST['razaoSocial'],$_POST['site'],$_POST['quantidadeImoveisLoc'],$_POST['quantidadeImoveisVend'],$_POST['telefone1'],$_POST['telefone2'],$_POST['contatoImobiliaria'],$_POST['funcContatoImobiliaria'],$_POST['email'],$_POST['integrador'],$_POST['zonaReg'],$_POST['cep'],$_POST['endereco'],$_POST['cidade'],$_POST['bairro'],$_POST['estado'],$_POST['numero'],$_POST['origemDados'],$_POST['portais'],$_POST['dataProposta'],$_POST['propostaEnviada'],$_POST['idVendedor']);

		if( $cliente->cadastraCliente($_POST['nomeCliente'],$_POST['razaoSocial'],$_POST['site'],$_POST['quantidadeImoveisLoc'],$_POST['quantidadeImoveisVend'],$_POST['telefone1'],$_POST['telefone2'],$_POST['contatoImobiliaria'],$_POST['funcContatoImobiliaria'],$_POST['email'],$_POST['integrador'],$_POST['zonaReg'],$_POST['cep'],$_POST['endereco'],$_POST['cidade'],$_POST['bairro'],$_POST['estado'],$_POST['numero'],$_POST['origemDados'],$_POST['portais'],$_POST['dataProposta'],$_POST['propostaEnviada'],$_POST['idVendedor'])  ){
			echo "<script>alert('Cliente cadastrado com sucesso');</script>";
			echo '<script>window.location.replace("relatorio.php")</script>';
		}else{
			echo "<script>alert('Houve um problema tente novamente');</script>";
		}

	}else if( isset( $_POST['action'] ) && $_POST['action'] == 'AlteraCadastro'){ 

		$cliente = new Cliente();

		$result = $cliente->atualizaFormCliente($_POST['nomeCliente'],$_POST['razaoSocial'],$_POST['site'],$_POST['quantidadeImoveisLoc'],$_POST['quantidadeImoveisVend'],$_POST['telefone1'],$_POST['telefone2'],$_POST['contatoImobiliaria'],$_POST['funcContatoImobiliaria'],$_POST['email'],$_POST['integrador'],$_POST['zonaReg'],$_POST['cep'],$_POST['endereco'],$_POST['cidade'],$_POST['bairro'],$_POST['estado'],$_POST['numero'],$_POST['origemDados'],$_POST['portais'],$_POST['dataProposta'],$_POST['propostaEnviada'],$_POST['idVendedor'],$_POST['idCliente']);

		if( $result == 1 ){
			echo "<script>alert('Cliente alterado com sucesso');</script>";
			echo $url = "cadastroClientes.php?idCliente=".$_POST['idCliente'];
			// header("location: ".$url)
			echo '<script>window.location.replace("'.$url.'")</script>';
		}else{
			echo "<script>alert('Houve um problema tente novamente');</script>";
		}

	}

	if( isset($_GET['idCliente']) && $_GET['idCliente'] != ''){

		$cliente = new Cliente();
		$result = $cliente->infoCliente($_GET['idCliente']);

		$clienteInfo = $result[0];
	}


	include("includes/header.php");
 ?>

			<div class="main-content" id="cadastroCliente">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="jqgrid.html">Listagem de clientes</a>
							</li>
							<li class="active">Cadastrar clientes</li>
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
							<h1>
								Cadastro de clientes
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Cadastre aqui os clientes
								</small>
							</h1>
						</div><!-- /.page-header -->

						<form class="form-horizontal" method="post">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nome do Cliente </label> -->

										<div class="col-sm-12" style="position:relative;">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_nome'])?>"  placeholder="Nome Fantasia" class="col-xs-10 col-sm-9" name="nomeCliente" id="nomeCliente" required maxlength=200/>
											<div class="listaIstantSearch col-xs-10 col-sm-9 hide">
											</div>											
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nome do Cliente </label> -->

										<div class="col-sm-12">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_razao'])?>"  placeholder="Razao Social" class="col-xs-10 col-sm-9" name="razaoSocial" />
										</div>
									</div>
									
									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Site </label> -->

										<div class="col-sm-12">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_site'])?>"  placeholder="Site" class="col-xs-10 col-sm-9" name="site"/>
										</div>
									</div>						

									<div class="space-4"></div>												

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Quantidade de imoveis </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Nº Imoveis Locação" value="<?php echo $clienteInfo['cli_quantidade_imoveis']?>" class="col-xs-10 col-sm-9" name="quantidadeImoveisLoc" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Quantidade de imoveis </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Nº Imoveis Venda" value="<?php echo $clienteInfo['cli_quantidade_imoveis_venda']?>" class="col-xs-10 col-sm-9" name="quantidadeImoveisVend" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Telefone </label> -->

										<div class="col-sm-12">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_telefone'])?>"  placeholder="Telefone Fixo" class="col-xs-10 col-sm-9 phone" name="telefone1" />
										</div>
										<div class="col-sm-12">
											<span style="color:red;" class="hide avisoPhone">Telefone Ja cadastrado no sistema</span>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Telefone </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Telefone Celular" value="<?php echo utf8_encode($clienteInfo['cli_telefone2'])?>" class="col-xs-10 col-sm-9 phone" name="telefone2" />
										</div>
										<div class="col-sm-12">
											<span style="color:red;" class="hide avisoPhone">Telefone Ja cadastrado no sistema</span>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Contato na imobiliária </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Contato" value="<?php echo utf8_encode($clienteInfo['cli_nome_contato'])?>" class="col-xs-10 col-sm-9" name="contatoImobiliaria" />
										</div>
									</div>


									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> Contato na imobiliária </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Função do contato" value="<?php echo utf8_encode($clienteInfo['cli_contato_funcao'])?>" class="col-xs-10 col-sm-9" name="funcContatoImobiliaria" />
										</div>
									</div>

									<div class="space-4"></div>
									

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> E-mail </label> -->

										<div class="col-sm-12">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_email'])?>" placeholder="E-mail" class="col-xs-10 col-sm-9" name="email"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nº </label> -->

										<div class="col-sm-12">
											<input type="text"  value="<?php echo utf8_encode($clienteInfo['cli_integrador'])?>" placeholder="Integrador" class="col-xs-10 col-sm-9" name="integrador"/>
										</div>
									</div>

									<!-- <div class="form-group">

										<div class="col-sm-12">
											<input type="text" placeholder="Nº do Documento" class="col-xs-10 col-sm-9" name="documento" id="numDoc"/>
										</div>
									</div> -->

									<div class="space-4"></div>
								</div>

								<div class="col-xs-6">
				
									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-2"> E-mail </label> -->

										<div class="col-sm-12">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_regiao'])?>"  placeholder="Zona ou Região" class="col-xs-10 col-sm-9" name="zonaReg"/>
										</div>
									</div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Cep </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="CEP" value="<?php echo utf8_encode($clienteInfo['cli_cep'])?>"  class="col-xs-10 col-sm-9" name="cep" id="cep" />
										</div>
									</div>																		
									
									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Endereço </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Endereço" value="<?php echo utf8_encode($clienteInfo['cli_endereco'])?>"  class="col-xs-10 col-sm-9" id="endereco" name="endereco"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Cidade </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Cidade"  value="<?php echo utf8_encode($clienteInfo['cli_cidade'])?>" class="col-xs-10 col-sm-9" id="cidade" name="cidade" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Bairro </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Bairro" class="col-xs-10 col-sm-9" value="<?php echo utf8_encode($clienteInfo['cli_bairro'])?>" id="bairro" name="bairro"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Estado </label> -->

										<div class="col-sm-12">
											Estado: 
											<select style="width:200px;" maxlength="150" id="estado" name="estado" required/>
											<option value="">Selecione ...</option>

											

											 <option value="AC" <?=( $clienteInfo['cli_uf'] == 'AC' ) ? "selected":""; ?>>Acre</option>
											 <option value="AL" <?=( $clienteInfo['cli_uf'] == 'AL' ) ? "selected":""; ?>>Alagoas</option>
											 <option value="AP" <?=( $clienteInfo['cli_uf'] == 'AP' ) ? "selected":""; ?>>Amapá</option>
											 <option value="AM" <?=( $clienteInfo['cli_uf'] == 'AM' ) ? "selected":""; ?>>Amazonas</option>
											 <option value="BA" <?=( $clienteInfo['cli_uf'] == 'BA' ) ? "selected":""; ?>>Bahia</option>
											 <option value="CE" <?=( $clienteInfo['cli_uf'] == 'CE' ) ? "selected":""; ?>>Ceará</option>
											 <option value="DF" <?=( $clienteInfo['cli_uf'] == 'DF' ) ? "selected":""; ?>>Distrito Federal</option>
											 <option value="GO" <?=( $clienteInfo['cli_uf'] == 'GO' ) ? "selected":""; ?>>Goiás</option>
											 <option value="ES" <?=( $clienteInfo['cli_uf'] == 'ES' ) ? "selected":""; ?>>Espírito Santo</option>
											 <option value="MA" <?=( $clienteInfo['cli_uf'] == 'MA' ) ? "selected":""; ?>>Maranhão</option>
											 <option value="MT" <?=( $clienteInfo['cli_uf'] == 'MT' ) ? "selected":""; ?>>Mato Grosso</option>
											 <option value="MS" <?=( $clienteInfo['cli_uf'] == 'MS' ) ? "selected":""; ?>>Mato Grosso do Sul</option>
											 <option value="MG" <?=( $clienteInfo['cli_uf'] == 'MG' ) ? "selected":""; ?>>Minas Gerais</option>
											 <option value="PA" <?=( $clienteInfo['cli_uf'] == 'PA' ) ? "selected":""; ?>>Pará</option>
											 <option value="PB" <?=( $clienteInfo['cli_uf'] == 'PB' ) ? "selected":""; ?>>Paraiba</option>
											 <option value="PR" <?=( $clienteInfo['cli_uf'] == 'PR' ) ? "selected":""; ?>>Paraná</option>
											 <option value="PE" <?=( $clienteInfo['cli_uf'] == 'PE' ) ? "selected":""; ?>>Pernambuco</option>
											 <option value="PI" <?=( $clienteInfo['cli_uf'] == 'PI' ) ? "selected":""; ?>>Piauí­</option>
											 <option value="RJ" <?=( $clienteInfo['cli_uf'] == 'RJ' ) ? "selected":""; ?>>Rio de Janeiro</option>
											 <option value="RN" <?=( $clienteInfo['cli_uf'] == 'RN' ) ? "selected":""; ?>>Rio Grande do Norte</option>
											 <option value="RS" <?=( $clienteInfo['cli_uf'] == 'RS' ) ? "selected":""; ?>>Rio Grande do Sul</option>
											 <option value="RO" <?=( $clienteInfo['cli_uf'] == 'RO' ) ? "selected":""; ?>>Rondônia</option>
											 <option value="RR" <?=( $clienteInfo['cli_uf'] == 'RR' ) ? "selected":""; ?>>Roraima</option>
											 <option value="SP" <?=( $clienteInfo['cli_uf'] == 'SP' ) ? "selected":""; ?>>São Paulo</option>
											 <option value="SC" <?=( $clienteInfo['cli_uf'] == 'SC' ) ? "selected":""; ?>>Santa Catarina</option>
											 <option value="SE" <?=( $clienteInfo['cli_uf'] == 'SE' ) ? "selected":""; ?>>Sergipe</option>
											 <option value="TO" <?=( $clienteInfo['cli_uf'] == 'TO' ) ? "selected":""; ?>>Tocantins</option>
											 </select>											
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nº </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Nº" value="<?php echo utf8_encode($clienteInfo['cli_numero'])?>" class="col-xs-10 col-sm-9" name="numero"/>
										</div>
									</div>

									<div class="space-4"></div>



									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nº </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Origem dos dados" value="<?php echo utf8_encode($clienteInfo['cli_parceiros'])?>"  class="col-xs-10 col-sm-9" name="origemDados"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nº </label> -->

										<div class="col-sm-12">
											<input type="text"  placeholder="Portais Parceiros" value="<?php echo utf8_encode($clienteInfo['cli_data_proposta'])?>" class="col-xs-10 col-sm-9" name="portais"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<div class="col-sm-12">
										Proposta Enviada? 
											<select style="width:100px;" maxlength="150" name="propostaEnviada"/>
											 	<option value="N" <?=( $clienteInfo['cli_proposta_enviada'] == 'N' ) ? "selected":""; ?>>Não</option>
											 	<option value="S" <?=( $clienteInfo['cli_proposta_enviada'] == 'S' ) ? "selected":""; ?>>Sim </option>
											</select>											
										</div>
									</div>

									<div class="space-4"></div>


									<div class="form-group">
										<!-- <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Nº </label> -->

										<div class="col-sm-12">
											<input type="text" value="<?php echo utf8_encode($clienteInfo['cli_data_proposta'])?>"  placeholder="Data da proposta" class="dateInput col-xs-10 col-sm-9" name="dataProposta"/>
										</div>
									</div>


									<div class="space-4"></div>
								</div>
							</div><!-- /.col -->
							<div class="row">
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<input type="hidden" name="action" value="<?=( isset($_GET['idCliente']) ) ? 'AlteraCadastro' : 'cadastraCliente'; ?>">
										<input type="hidden" name="idCliente" id="idCliente" value="<?=$clienteInfo['cli_id']?>">
										<button type="submit" class="btn btn-info cadastraCliente" type="button">
											<i class="ace-icon fa fa-check bigger-110"></i>
										Salvar cliente
										</button>
								
										&nbsp; &nbsp; &nbsp;
										<button class="btn" id="cadastraCMS" type="button">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											Cadastrar cliente no CMS
										</button>
										<input type="hidden" name="idVendedor" value="0">
									</div>
								</div>
							</div>
					    </form>	

						</div><!-- /.row -->


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

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/cadastroClientesScript.js"></script>

		<?php  include('modalAviso.php'); ?>


		<!-- inline scripts related to this page -->
		<script type="text/javascript">

			$.mask.definitions['h'] = "[a-z,A-Z]"
			$('.phone').mask("(99) 9999-9999?9");
			$('#numDoc').mask("999.999.999-99");
			$('#cep').mask("99999-999");	
			$('.dateInput').mask("99/99/9999");	

		</script>
	</body>
</html>
