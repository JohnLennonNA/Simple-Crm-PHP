<?php  
include("../class/class.agenda.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

// echo "<pre>";
// print_r($_GET);

// exit();

$teste = new Agenda();
echo $result = $teste->cadastraAlerta($_GET['idVendedor'], $_GET['idCliente'], "Vazio", $_GET['data'], $_GET['avisoHora'] );

// }
