<?php
header('Content-Type: text/html; charset=utf-8');
include("../class/class.gestor.php");

$gestor = new Gestor();

if( $gestor->verificaGestor($_GET['idGestor']) == 0 ){
	$gestor->insereGestor($_GET['idGestor'], $_GET['varIn'] );
}else{
	$gestor->atualizaGestor($_GET['idGestor'], $_GET['varIn']);
}


foreach ($result as $key => $value) {
	echo '<option value="'.$value['cli_id'].'">'.utf8_encode($value['cli_nome']).' | LOCAÇÃO:'.utf8_decode($value['cli_quantidade_imoveis']).'</option>';
}


// echo "<pre>";
// print_r($result);

?>