<?php 

include("../class/class.status.php");


// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$status = new Status();

$result = $status->listaStatus();


foreach ($result as $key => $value) {
	$statusSelectValues[$value['sta_status']][] = $value['sta_referencia'];
	$statusSelectValuesId[$value['sta_status']][] = $value['sta_id'];
	$statusSelectValuesNome[$value['sta_status']][] = $value['sta_nome'];
}

		
$loop = $statusSelectValues[$_GET['status']];

$flag = 0;

foreach ($loop as $key => $value){
	
	// echo ;
		echo '<option value="'.$statusSelectValuesId[$_GET['status']][$flag].'">'.$value.' - '.utf8_encode($statusSelectValuesNome[$_GET['status']][$flag]).'</option>';
	$flag++;

}

// $statusSelectValuesId[$key][$flag]

// echo "<pre>";
// print_r($statusSelectValues);
// <div class="col-sm-10">
// 	<label for="" style="width:100px;">Sub-Status
// 		<select style="width:380px;" maxlength="150" id="substatus" name="estado"/>
// 	 	</select>
//  	</label>
// </div>
