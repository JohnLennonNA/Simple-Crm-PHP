<?php 
header('Content-Type: application/json');

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

include("../class/class.agenda.php");

$aviso = new Agenda();
$result = $aviso->listaEventos($_GET['idVendedor'], $_GET['horaBusca']);


if($result){
	$result[0]['erro'] = 0;
	echo json_encode($result[0]);	
}else{
	$resposta['erro'] = 1;
	echo json_encode($resposta);	
}



