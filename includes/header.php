<?php 
session_start();

if( empty($_SESSION['_sf2_attributes']['nomeUser']) && empty($_SESSION['_sf2_attributes']['idUser']) ){
	header("location: /cms ");
}

$fraseAviso = "";

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Listagem de clientes </title>

		<meta name="description" content="Dynamic tables and grids using jqGrid plugin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" href="assets/css/fullcalendar.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<link rel="stylesheet" href="assets/css/styleGlobal.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">

<div style="position: fixed; width: 190px; display: block; bottom: 30px; font-size: 12px; left: 0;text-align: center;"><?=$fraseAviso?></div>

		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<!-- <i class="fa fa-leaf"></i> -->
							<img src="http://localhost/web/site/images/logo.png" style="width:90px;" alt="">
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">



						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info" id="userInfo" idVendedor="<?=$_SESSION['_sf2_attributes']['idUser'];?>" userProfile="<?=$_SESSION['_sf2_attributes']['profileUser']?>">
									<small>Bem Vindo,</small>
									<?=$_SESSION['_sf2_attributes']['nomeUser'];?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li>
									<a href="/cms">
										<i class="ace-icon fa fa-user"></i>
										Retornar ao CMS
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="/cms/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Sair
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">

			<div id="sidebar" class="sidebar responsive">

				<!-- MENU LATERAL -->
				<ul class="nav nav-list">
					<li class="">
						<a href="index.php">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Inicial </span>
						</a>
						<b class="arrow"></b>
					</li>

				<?php// if ( $_SESSION['_sf2_attributes']['profileUser'] == 2 || $_SESSION['_sf2_attributes']['profileUser'] == 4 || $_SESSION['_sf2_attributes']['profileUser'] == 7  ) :?>
					<li class="">
						<a href="atendimento.php">
							<i class="menu-icon fa fa-headphones"></i>
							<span class="menu-text"> Atendimento </span>
						</a>

						<b class="arrow"></b>
					</li>
				<?php// endif; ?>
				
				<?php if ( $_SESSION['_sf2_attributes']['profileUser'] == 2 || $_SESSION['_sf2_attributes']['profileUser'] == 5 || $_SESSION['_sf2_attributes']['profileUser'] >= 7 || $_SESSION['_sf2_attributes']['profileUser'] == 6) :?>
					<li class="">
						<a href="calendario.php">
							<i class="menu-icon fa fa-calendar"></i>
							<span class="menu-text"> Agenda </span>
						</a>
						<b class="arrow"></b>
					</li>
				<?php endif; ?>

					<li class="">
						<a href="cadastroClientes.php">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Cadastrar Cliente </span>
						</a>
						<b class="arrow"></b>
					</li>
				
					<li class="">
						<!-- <a href="relatorio.php"> -->
						<a href="relatorioExtra.php">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Relatorio Resumo </span>
						</a>
						<b class="arrow"></b>
					</li>

<!-- 					<li class="">
						<a >
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Relatorio Geral (Manutenção) </span>
						</a>
						<b class="arrow"></b>
					</li> -->

				<?php if ( $_SESSION['_sf2_attributes']['profileUser'] != 2 &&  $_SESSION['_sf2_attributes']['profileUser'] < 7 ) :?>
					<li class="">
						<a href="atribuicoes.php">
							<i class="menu-icon fa fa-sitemap"></i>
							<span class="menu-text"> Atribuições Vendedor </span>
						</a>
						<b class="arrow"></b>
					</li>
				<?php endif; ?>

				<?php if ( $_SESSION['_sf2_attributes']['profileUser'] == 1 ) :?>
					<li class="">
						<a href="atribuicoesGestor.php">
							<i class="menu-icon fa fa-sitemap"></i>
							<span class="menu-text"> Atribuições Gestor </span>
						</a>
						<b class="arrow"></b>
					</li>
				<?php  endif; ?>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

			</div>




