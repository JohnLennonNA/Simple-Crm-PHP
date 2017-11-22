<?php
header('Content-Type: text/html; charset=utf-8');
include("../class/class.cliente.php");
include("../class/class.historico.php");
include("../class/class.user.php");

$cliente = new Cliente();
$historico = new Historico();
$user = new User();

$result = $cliente->atualizaCliente($_GET['idVendedor'], $_GET['varIn']);

$codigoDefault = 5;

if($_GET['profileId'] == 8 ){
	$codigoDefault = 27;	
}

if( $_GET['operacao'] == 'add'){
	$idList = rtrim( ltrim($_GET['varIn'], "(") , ")");
	$idList =  explode(",", $idList);

	foreach ($idList as $key => $value){

		$usuario = $user->listaUser(0, $_GET['idVendedor']);
		$usuario = $usuario[0]['nome'];

		$cliente->atualizaStatusCliente($codigoDefault, $value);

		$texto = "Cliente alterado para o novo vendedor(a): ".$usuario;
		$historico->cadastraHistorico($value, $texto, 10, 'N', 2 );
	}
}else if( $_GET['operacao'] == 'transferencia' ){

	$idList = rtrim( ltrim($_GET['varIn'], "(") , ")");
	$idList =  explode(",", $idList);

	foreach ($idList as $key => $value){
		$cliente->atualizaStatusCliente($codigoDefault, $value);
	}
}

?>