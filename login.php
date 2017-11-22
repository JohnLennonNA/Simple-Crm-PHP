<?php 

if($_GET['id']){
	session_start();	
	$_SESSION['_sf2_attributes']['idUser'] = base64_decode($_GET['id']);
	$_SESSION['_sf2_attributes']['nomeUser'] = $_GET['nomeUser'];
	$_SESSION['_sf2_attributes']['emailUser'] = $_GET['emailUser'];
	$_SESSION['_sf2_attributes']['profileUser'] = $_GET['profileUser'];

	// echo "teste";

	header("Location: index.php");

	// echo "<pre>";
	// print_r($_SESSION);	
	// echo "</pre>";
	// exit();
}

