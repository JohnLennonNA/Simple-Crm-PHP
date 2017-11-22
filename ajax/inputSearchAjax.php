<?php
header('Content-Type: text/html; charset=utf-8');
include("../class/class.relatorios.php");

$relatorio = new Relatorio();

if( $_GET['action'] == 'listaBairro' ){
	$result = $relatorio->buscaBairros($_GET['string']);
	foreach ($result as $key => $value) {
		if(  $value['cli_bairro'] != '' ){
			echo "<p class='listSearch'>".$value['cli_bairro']."</p>";
		}
	}
}else if( $_GET['action'] == 'listaCidade' ){
	$result = $relatorio->buscaCidades($_GET['string']);
	foreach ($result as $key => $value) {
		if(  $value['cli_cidade'] != '' ){
			echo "<p class='listSearch'>".utf8_encode($value['cli_cidade'])."</p>";
		}
	}
}else if( $_GET['action'] == 'listaImobiliarias' ){
	$result = $relatorio->buscaImobiliarias($_GET['string']);
	foreach ($result as $key => $value) {
		if(  $value['cli_nome'] != '' ){
			echo "<p class='listSearch' ref='idImobiliaria' id='".$value['cli_id']."'>".utf8_encode($value['cli_nome'])."</p>";
		}
	}
}else if( $_GET['action'] == 'listaVendedores' ){
	$result = $relatorio->buscaVendedores($_GET['string']);
	foreach ($result as $key => $value) {
		if(  $value['nome'] != '' ){
			echo "<p class='listSearch' ref='idVendedor' id='".$value['id']."'>".utf8_encode($value['nome'])."</p>";
		}
	}

	// ARTIFICIO TECNICO
	$pos2 = stripos('sem vendedor', $_GET['string'] );
	if ($pos2 !== false) {
		echo "<p class='listSearch' ref='idVendedor' id='0'>Sem vendedor</p>";
	}
	// ==================
}

?>