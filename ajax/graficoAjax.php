<?php
// header('Content-Type: application/json');
include("../class/class.relatorios.php");
include("../class/class.user.php");

$relatorio = new Relatorio();
$user = new User();

$data = $_GET['mesAno'].'-01';
$mesBusca = explode('-',$_GET['mesAno']);



if( $_SESSION['_sf2_attributes']['profileUser'] == 2 || !empty($_GET['idVendedor']) ){
	if(!empty($_GET['idVendedor'])){				
		$resultUser = $user->listaUser(2,$_GET['idVendedor']);
	}else{
		$resultUser = $user->listaUser(2,$_SESSION['_sf2_attributes']['idUser']);
	}
}else{	
	$resultUser = $user->listaUser(2);
}


// GERA DADOS RELATORIOS DIARIO
	$dadosDay = array();
	$dadosDay['descricao'][0] = 'Dia';
	foreach ($resultUser as $key => $value){
		$dadosDay['descricao'][$value['id']] = $value['nome'];
	}

	// echo "<br><br>";
	
	$linhaFlag = date("t", strtotime( date( $data ) ) );
	$mesAnoDia = date( $_GET['mesAno'].'-'.$linhaFlag);

	while($linhaFlag > 0){
		foreach ($dadosDay['descricao'] as $key => $value){
			if($key == 0){
				$dadosDay[$mesAnoDia][0] = date('d/m', strtotime($mesAnoDia));
			}else{
				$resultGraf = $relatorio->geraDadosGraficoDays($mesAnoDia, $key);
				$dadosDay[$mesAnoDia][$key] = $resultGraf[0]['total'];
			}
		}
		$mesAnoDia = date('Y-m-d', strtotime('-1 day', strtotime($mesAnoDia)) );

		$linhaFlag--;
	}

	$graficoDadosDay = '';


	$graficoDadosDay .= '[';
	foreach ( $dadosDay['descricao'] as $key => $value) {
	    $graficoDadosDay .= "'".$value."',";					
	}
	$graficoDadosDay = substr($graficoDadosDay, 0, -1).'],';

	// print_r($graficoDadosDay);
	unset($dadosDay['descricao']);

	$dadosDay = array_reverse($dadosDay);

	foreach ( $dadosDay as $key => $value) {
		$graficoDadosDay .= '[';
		foreach ($value as $chav => $val){
			 if($chav == 0){
				$graficoDadosDay .= "'".$val."',";
			}else{
				$graficoDadosDay .= $val.",";
			}
		}
		$graficoDadosDay = substr($graficoDadosDay, 0, -1).'],';
	}


	echo substr($graficoDadosDay,0,-1);

// FIM GERA DADOS RELATORIOS DIARI


?>