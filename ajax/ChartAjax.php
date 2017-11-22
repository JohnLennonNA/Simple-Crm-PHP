<?php
// header('Content-Type: application/json');
include("../class/class.relatorios.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);



// echo json_encode('[["Dia","Cassiele Cunha"],["01/04",0],["02/04",0],["03/04",0],["04/04",6]]');

// echo json_encode('[["Dia","N","S"],
// ["01/04",0,0],
// ["02/04",0,0],
// ["03/04",0,0],
// ["04/04",22,6]]');

// echo '[["Dia","\"N\", \"S\"\"],[\"01\/04\",0,0],[\"02\/04\",0,0],[\"03\/04\",0,0],[\"04\/04\",7,7]]';
// exit();

$resultUser =  json_decode($_POST['resultUser']);
$filters =  json_decode($_POST['filters']);

// echo "<pre>";
// print_r($resultUser);

function generateMothOverDay( $parameterMonth, $parameterYear, $resultUser, $filters =  "" ){
	$relatorio = new Relatorio();

	if($filters->cidade != ''){
		$relatorio->cidade = $filters->cidade;
	}

	if($filters->idVendedor != ''){
		$relatorio->idVendedor = $filters->idVendedor;
	}

	if($filters->idCliente != ''){
		$relatorio->idCliente = $filters->idCliente;
	}

	if($filters->uf != ''){
		$relatorio->uf = $filters->uf;
	}

	if($filters->status != ''){
		$relatorio->status = $filters->status;
	}

	$dadosDay = array();
	$dadosDay['descricao'][0] = "Dia";

	foreach ($resultUser as $key => $value){
		if($value->nome != ''){
			if($relatorio->idVendedor != ''){
				$dadosDay['descricao'][$value->id] = 'N", "S';
			}else{
				$dadosDay['descricao'][$value->id] = $value->nome;
			}
		}
	}

	$title = ' dos ultimos 30 dias';

	$mes = $parameterMonth;
	$ano = date($parameterYear);
	$title = ' do Mês de ';

	switch ($mes){
		case '01':
			$title .= 'Janeiro';
			break;
		case '02':
			$title .= 'Fevereiro';
			break;
		case '03':
			$title .= 'Março';
			break;
		case '04':
			$title .= 'Abril';
			break;
		case '05':
			$title .= 'Maio';
			break;
		case '06':
			$title .= 'Junho';
			break;
		case '07':
			$title .= 'Julho';
			break;
		case '08':
			$title .= 'Agosto';
			break;
		case '09':
			$title .= 'Setembro';
			break;
		case '10':
			$title .= 'Outubro';
			break;
		case '11':
			$title .= 'Novembro';
			break;
		case '12':
			$title .= 'Dezembro';
			break;
	}

	if($mes == date('m')){
		$linhaFlag = date('d');
	}else{
		$linhaFlag = date("t", mktime( 0,0,0,$mes,'01',$ano ));
	}

	$formaData = $ano."-".$mes."-".$linhaFlag;

	$mesAnoDia = date($formaData);

	while($linhaFlag > 0){
		foreach ($dadosDay['descricao'] as $key => $value){
			if($key == 0){
				$dadosDay[$mesAnoDia][0] = date('d/m', strtotime($mesAnoDia));
			}else{			
				if($relatorio->idVendedor != ''){
					$resultGraf = $relatorio->generateDataDays($mesAnoDia, $key, 2);
					$dadosDay[$mesAnoDia][$key]['N'] = ( $resultGraf[0]['total'] != '') ? $resultGraf[0]['total'] : 0;
					$dadosDay[$mesAnoDia][$key]['S'] = ( $resultGraf[1]['total'] != '') ? $resultGraf[1]['total'] : 0;
				}else{
					$resultGraf = $relatorio->generateDataDays($mesAnoDia, $key);
					$dadosDay[$mesAnoDia][$key] = $resultGraf[0]['total'];
				}
			}
		}
		$mesAnoDia = date('Y-m-d', strtotime('-1 day', strtotime($mesAnoDia)) );
		$linhaFlag--;
	}


	// echo "<pre>";
	// print_r($dadosDay);

	$graficoDadosDay = '';

	$graficoDadosDay .= '[';
	foreach ( $dadosDay['descricao'] as $key => $value) {
	    $graficoDadosDay .= '"'.$value.'",';
	}
	$graficoDadosDay = substr($graficoDadosDay, 0, -1).'],';
	
	// echo "<pre>";
	// print_r($graficoDadosDay);

	unset($dadosDay['descricao']);

	$dadosDay = array_reverse($dadosDay);

	// print_r($dadosDay);

	foreach ( $dadosDay as $key => $value) {
		$graficoDadosDay .= '[';
		foreach ($value as $chav => $val){
			if($chav == 0){
					$graficoDadosDay .= '"'.$val.'",';
			}else{
				if($relatorio->idVendedor != ''){
					$graficoDadosDay .= $val['N'].",".$val['S'].",";
				}else{
					$graficoDadosDay .= $val.",";
				}
			}
		}

		$graficoDadosDay = substr($graficoDadosDay, 0, -1).'],';
	}

	// echo $varteste = '['.substr($graficoDadosDay, 0, -1).']';

	$return = '['.substr($graficoDadosDay, 0, -1).']';
	echo json_encode($return);
	// echo str_replace("\\", "", json_encode($return));

// str_replace(search, replace, subject)

}

if( isset($_POST['mes']) && isset($_POST['ano']))
{
	generateMothOverDay($_POST['mes'], $_POST['ano'], $resultUser, $filters );
}else{
	generateMothOverDay(date('m'), date('Y'), $resultUser, $filters );
}




?>