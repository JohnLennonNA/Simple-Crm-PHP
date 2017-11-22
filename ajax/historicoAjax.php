<?php  
include("../class/class.historico.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$teste = new Historico();

if($_GET['action'] == 'listagemHistorico')
{

	if( isset($_GET['dataAte']) &&  isset($_GET['dataDe'])){
		$result = $teste->listaHistorico($_GET['idCliente'], $_GET['dataDe'], $_GET['dataAte'] );	
	}else{
		$result = $teste->listaHistorico($_GET['idCliente']);
	}

	// echo $result;
	
	if($result)
	{
		foreach ($result as $key => $value){

			$classDestaque = ( $value['his_tipo'] == 1 ) ? "destaqueHistorico" : "";

			$decisor = ( $value['his_decisor'] == '') ? 'N': $value['his_decisor'];

			echo '<div class="itemdiv dialogdiv">
				<div class="body '.$classDestaque.'">
					<div class="time">
						<i class="ace-icon fa fa-clock-o"></i>
						<span class="green">'.date('H:i', strtotime($value['his_data_cadastro'])).'</span>
					</div>

					<div class="name">'.
						date('d/m/Y', strtotime($value['his_data_cadastro'])).'</div>
					<div class="text">'.$value['his_conteudo'].' - (<b>'.$decisor.'</b>)</div>
					<div class="text">por: '.$value['nomeVendedor'].'</div>
				</div>
			</div>';
		}
	}else{
		echo '<i class="fa fa-exclamation-triangle iconeEmptyHistory"></i><p class="piconeEmptyHistory">Este cliente ainda não tem historico de atendimento</p>';
	}



}else if($_GET['action'] == 'registraHistorico'){

	echo $result = $teste->cadastraHistorico($_GET['idCliente'], $_GET['feedContent'], $_GET['idVendedor'], $_GET['statusFeed']);

}
