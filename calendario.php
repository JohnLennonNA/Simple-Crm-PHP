<?php 
	
	include_once ("includes/header.php");
	include_once ("class/class.agenda.php");
	include_once ("class/class.user.php");

	// echo "<pre>";
	// print_r($_SESSION);

	$agenda = new Agenda();
	$user = new User();

	if($_SESSION['_sf2_attributes']['profileUser'] == 5){
		$result = $agenda->listaEventosNextTree($_SESSION['_sf2_attributes']['idUser'], 1);
	}else{
		$result = $agenda->listaEventosNextTree($_SESSION['_sf2_attributes']['idUser']);
	}

	$stringCalendar = '';

	// inverse
	// primary
	// warning
	// danger
	// success

	foreach ($result as $key => $value) {

		switch ($value['age_id_vendedor']){
			case '6':
			case '8':
			case '11':
			case '18':
			case '17':
			case '21':
			case '25':
			case '29':
			case '33':
			case '37':
			case '41':
			case '45':
			case '49':
			case '53':
				$class = 'success';
				break;
			case '22':
			case '26':
			case '30':
			case '34':
			case '38':
			case '42':
			case '46':
			case '50':
				$class = 'primary';
				break;
			case '23':
			case '27':
			case '31':
			case '35':
			case '39':
			case '43':
			case '47':
			case '51':
				$class = 'danger';
				break;
			case '24':
			case '28':
			case '32':
			case '36':
			case '40':
			case '44':
			case '48':
			case '52':
				$class = 'warning';
				break;
			default:
				$class = 'warning';
				break;
		}

		$stringCalendar .= '{
		title: "Ligar para : \n '.utf8_encode($value['cli_nome']).'",
		start: "'.$value['age_data_aviso'].'",
		className: "label-'.$class.'"
	  	},';
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
							<li class="active">Calendario</li>
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

						<div class="page-header">
							<h1>
								Agenda
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Marque aqui os seus compromissos.
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-sm-9">
										<div class="space"></div>

										<div id="calendar"></div>

										<br>

										<?php 

											if($_SESSION['_sf2_attributes']['profileUser'] == 5){
												$resulVend = $user->listaUser(2);

												foreach ($resulVend as $key => $value){

													if($value['id'] == 6 || $value['id'] == 11 || $value['id'] == 18 || $value['id'] == 17  ){
														echo '<div class="row">';
															switch ($value['id']){
																case '6':
																	echo '<p style="color:#fff;font-weight:bold;" class="col-sm-12 label-success">'.utf8_decode($value['nome']).'</p>';
																	break;
																case '11':
																	echo '<p style="color:#fff;font-weight:bold;" class="col-sm-12 label-primary">'.utf8_decode($value['nome']).'</p>';
																	break;
																case '18':
																	echo '<p style="color:#fff;font-weight:bold;" class="col-sm-12 label-danger">'.utf8_decode($value['nome']).'</p>';
																	break;
																case '17':
																	echo '<p style="color:#fff;font-weight:bold;" class="col-sm-12 label-warning">'.utf8_decode($value['nome']).'</p>';
																	break;
																default:
																	echo '<p style="color:#fff;font-weight:bold;" class="col-sm-12 label-warning">'.utf8_decode($value['nome']).'</p>';
																	break;
															}
														echo '</div>';
													}
												}
											}
										?>
									</div>

									<div class="col-sm-3">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4>Lembretes de hoje</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="external-events">
													<?php 

													if($_SESSION['_sf2_attributes']['profileUser'] == 5){
														$result = $agenda->listaEventos($_SESSION['_sf2_attributes']['idUser'], 0, 1, 1);
													}else{
														$result = $agenda->listaEventos($_SESSION['_sf2_attributes']['idUser'], 0, 1);
													}
													// $result = $agenda->listaEventos($_SESSION['_sf2_attributes']['idUser'], 0, 1);



													foreach ($result as $key => $value) {
													
														// echo "<pre>";
														// print_r($value['age_id_vendedor']);
														// echo "</pre>";

														switch ($value['age_id_vendedor']){
															case '6':
															case '8':
															case '11':
															case '18':
															case '17':
															case '21':
															case '25':
															case '29':
															case '33':
															case '37':
															case '41':
															case '45':
															case '49':
															case '53':
																$class = 'label-success';
																break;
															case '22':
															case '26':
															case '30':
															case '34':
															case '38':
															case '42':
															case '46':
															case '50':
																$class = 'label-primary';
																break;
															case '23':
															case '27':
															case '31':
															case '35':
															case '39':
															case '43':
															case '47':
															case '51':
																$class = 'label-danger';
																break;
															case '24':
															case '28':
															case '32':
															case '36':
															case '40':
															case '44':
															case '48':
															case '52':
																$class = 'label-warning';
																break;
															default:
																$class = 'label-warning';
																break;
														}

													?>

														<div  class="alert alert-block <?=$class?>">
															
															<?php if($_SESSION['_sf2_attributes']['profileUser'] != 5): ?>
															<a href="atendimento.php?idCliente=<?=$value['cli_id'];?>&nmCliente=<?=$value['cli_nome'];?>" style="color:#fff!important;">
															<?php else: ?>
															<div style="color:#fff!important;">
															<?php endif; ?>

																<strong>
																	<i class="ace-icon fa fa-check"></i>
																	Ligar
																</strong>
																|
																<strong>
																	<i class="ace-icon fa fa-clock-o"></i>
																	<?=$value['age_hora_aviso'];?>
																</strong>
																<br>
																<?=utf8_encode($value['cli_nome']);?>
															<?php if($_SESSION['_sf2_attributes']['profileUser'] != 5): ?>
															</a>
															<?php else: ?>
															</div>
															<?php endif; ?>
														</div>
													<?php } ?>
														


													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

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
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/fullcalendar.min.js"></script>
		<script src="assets/js/bootbox.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>


	<?php  include('modalAviso.php'); ?>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {

/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events div.external-event').each(function() {

		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};

		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});




	/* initialize the calendar
	-----------------------------------------------------------------*/

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();


	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		 buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
	
		header: {
			left: 'prev,next Hoje',
			center: 'title',
			right: ''
		},
		events: [

		<?php echo substr($stringCalendar, 0, -1); ?>

		 //  {
			// title: ' Ligar para imobiliaria FUlano de tal',
			// start: "2015-09-17",
			// // end: "2015-08-22",
			// allDay: false,
			// className: 'label-info'
		 //  },

		]

		
	});


	// var teste = 
	// calendar.fullCalendar('clientEvents',function(event){
	// 	// console.log(event.start);
	// 	console.log(event.title);
	// 	console.log(event.start.format());
	// 	console.log(event.end.format());
	// });

	// console.log(teste);

	// console.log(calendar.fullCalendar('clientEvents'));
	// console.log(calendar.clientEvents('clientEvents')

})
		</script>


	</body>
</html>
