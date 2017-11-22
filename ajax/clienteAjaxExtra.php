<?php

// header('Content-Type: application/json');
include("../class/class.cliente.php");

$cliente = new Cliente();

$result = $cliente->infoCliente($_GET['idCliente']);

// echo "<pre>";
// print_r($result[0]);

$result[0]['cli_nome_contato'] = utf8_encode($result[0]['cli_nome_contato']);
$result[0]['cli_contato_funcao'] = utf8_encode($result[0]['cli_contato_funcao']);
$result[0]['cli_contato_funcao'] = utf8_encode($result[0]['cli_nome']);
$result[0]['cli_origem_dados'] = utf8_encode($result[0]['cli_origem_dados']);
$result[0]['cli_parceiros'] = utf8_encode($result[0]['cli_parceiros']);

echo json_encode($result[0]);

?>