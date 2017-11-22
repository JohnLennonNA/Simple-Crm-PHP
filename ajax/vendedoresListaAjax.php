<?php
header('Content-Type: text/html; charset=utf-8');
include("../class/class.user.php");

$user = new User();

if($_GET['action'] == 'vendedoresLivres')
{
	$result = $user->listaUserAtribuicoes();
}else if( $_GET['action'] == 'vendedoresGestor' ){
	$result = $user->listaUserAtribuicoes($_GET['idGestor']);
}

// echo '<pre>';
// print_r($result);

if($result){
	foreach ($result as $key => $value) {
		echo '<option value="'.$value['id'].'" profileid="'.$value['profileId'].'">'.utf8_encode($value['nome']).'</option>';
	}
}

?>