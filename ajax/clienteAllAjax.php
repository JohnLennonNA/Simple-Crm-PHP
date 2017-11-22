<?php
header('Content-Type: text/html; charset=utf-8');
include("../class/class.cliente.php");

$cliente = new Cliente();


if($_GET['action'] == 'listaAll')
{
	$result = $cliente->listaAllCliente($_GET['nome']);
	foreach ($result as $key => $value){
		echo "<p>".utf8_encode($value['cli_nome'])."</p>";
	}
}else if($_GET['action'] == 'verifPhone'){
	
	echo $result = $cliente->verifPhoneCliente( $_GET['phone'], $_GET['idNotSearch']);
	
	// echo "<pre>";
	// print_r($result);

	// echo count($result[0]);

}

?>