<?php
include("../class/class.cliente.php");
include("../class/class.historico.php");
include("../class/class.status.php");

$cliente = new Cliente();

$cliente->atualizaStatusCliente($_GET['newStatus'], $_GET['idCliente']);

// echo $_GET['newStatus'];
// CRIAR FUNÇÃO NOVA NA CLASSE CLIENTE
// if( $_GET['newStatus'] == 1 || $_GET['newStatus'] == 3 || $_GET['newStatus'] == 4 ){

// 	$_GET['idCliente']

// }

$status = new Status();
$contents = $status->listaStatus($_GET['newStatus']);

$content = "Status alterado para :".$contents[0]['sta_referencia']." - ".utf8_encode($contents[0]['sta_nome']);

$historico = new Historico();
$result = $historico->cadastraHistorico($_GET['idCliente'], $content, $_GET['idVendedor'], 'N', 1, $contents[0]['sta_referencia'] );

?>