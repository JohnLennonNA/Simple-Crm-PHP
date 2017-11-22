<?php  
include("../class/class.historico.php");

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);



$teste = new Historico();
$result = $teste->listaHistorico($_GET['idCliente']);


foreach ($result as $key => $value){
	echo '<div class="itemdiv dialogdiv">
		<div class="body">
			<div class="time">
				<i class="ace-icon fa fa-clock-o"></i>
				<span class="green">'.date('H:i', strtotime($value['his_data_cadastro'])).'</span>
			</div>

			<div class="name">'.
				date('d/m/Y', strtotime($value['his_data_cadastro'])).'</div>
			<div class="text">'.$value['his_conteudo'].'</div>
		</div>
	</div>';

}?>