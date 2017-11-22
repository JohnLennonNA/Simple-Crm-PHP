<?php
header('Content-Type: text/html; charset=utf-8');
include("../class/class.cliente.php");

$cliente = new Cliente();

if($_GET['likeName'] != '')
{
	$result = $cliente->listaCliente($_GET['idVendedor'], '0', '0', $_GET['selectEstado'], $_GET['likeName']);
}else{
	$result = $cliente->listaCliente($_GET['idVendedor'], '0', '0', $_GET['selectEstado']);
}


foreach ($result as $key => $value) {
	echo '<option value="'.$value['cli_id'].'">'.utf8_encode($value['cli_nome']).' | LOCAÇÃO:'.utf8_decode($value['cli_quantidade_imoveis']).'</option>';
}


// echo "<pre>";
// print_r($result);

?>