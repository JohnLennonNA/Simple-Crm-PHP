<?php  
include("../class/class.agenda.php");

$teste = new Agenda();
echo $result = $teste->atualizaEventos($_GET['idAviso']);

// }
