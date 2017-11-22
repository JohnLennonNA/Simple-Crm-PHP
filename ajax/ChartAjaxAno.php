<?php
// header('Content-Type: application/json');
include("../class/class.relatorios.php");
include("../class/class.user.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$resultUser =  json_decode($_POST['resultUser']);
$filters =  json_decode($_POST['filters']);

// print_r($resultUser);
// exit();


function generateAllMont( $resultUser, $filters =  "" ){
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
	// echo "<pre>";
	// print_r($resultUser);
	// echo "</pre>";
	// echo 'teste';

	$dados = array();
	$dados['descricao'][0] = 'Mês';

	foreach ($resultUser as $key => $value){
		if($value->nome != ''){
				// $dados['descricao'][$value->id] = $value->nome;
			if($relatorio->idVendedor != ''){
				$dados['descricao'][$value->id] = 'N", "S';
			}else{
				$dados['descricao'][$value->id] = $value->nome;
			}
		}

	}

	// echo "<pre>";
	// print_r($dados);
	// echo "</pre>";
	
	$ano = date('Y');
	$mes = date('m');

	$mesAno = $ano.'-'.$mes;

	$linhaFlag = 1;


	// echo "<pre>";
	// print_r($dados['descricao']);
	// echo "</pre>";


	while($linhaFlag < 13){
		foreach ($dados['descricao'] as $key => $value){
			if($key == 0){
				$mesNome = substr($mesAno, 5,2);
				switch ($mesNome) {
					case '01':
						$dados[$mesAno][0] = 'Janeiro | '.substr($mesAno, 0,4);
						break;
					case '02':
						$dados[$mesAno][0] = 'Fevereiro | '.substr($mesAno, 0,4);
						break;
					case '03':
						$dados[$mesAno][0] = 'Março | '.substr($mesAno, 0,4);
						break;
					case '04':
						$dados[$mesAno][0] = 'Abril | '.substr($mesAno, 0,4);
						break;
					case '05':
						$dados[$mesAno][0] = 'Maio | '.substr($mesAno, 0,4);
						break;
					case '06':
						$dados[$mesAno][0] = 'Junho | '.substr($mesAno, 0,4);
						break;
					case '07':
						$dados[$mesAno][0] = 'Julho | '.substr($mesAno, 0,4);
						break;
					case '08':
						$dados[$mesAno][0] = 'Agosto | '.substr($mesAno, 0,4);
						break;
					case '09':
						$dados[$mesAno][0] = 'Setembro | '.substr($mesAno, 0,4);
						break;
					case '10':
						$dados[$mesAno][0] = 'Outubro | '.substr($mesAno, 0,4);
						break;
					case '11':
						$dados[$mesAno][0] = 'Novembro | '.substr($mesAno, 0,4);
						break;
					case '12':
						$dados[$mesAno][0] = 'Dezembro | '.substr($mesAno, 0,4);
						break;
				}

			}else{
				if($relatorio->idVendedor != ''){
					$resultGraf = $relatorio->generateDataMonths($mesAno, $key, 2);
					$dados[$mesAno][$key]['N'] = ( $resultGraf[0]['total'] != '') ? $resultGraf[0]['total'] : 0;
					$dados[$mesAno][$key]['S'] = ( $resultGraf[1]['total'] != '') ? $resultGraf[1]['total'] : 0;
				}else{
					$resultGraf = $relatorio->generateDataMonths($mesAno, $key);
					$dados[$mesAno][$key] = $resultGraf[0]['total'];
				}

				//  $resultGraf = $relatorio->generateDataMonths($mesAno, $key);
				//  $dados[$mesAno][$key] = $resultGraf[0]['total'];
			}
		}
		$mesAno = date('Y-m', strtotime('-'.$linhaFlag.' month' ) );
		$linhaFlag++;
	}

	$graficoDados = '';

	$graficoDados .= '[';
	foreach ( $dados['descricao'] as $key => $value) {
	    $graficoDados .= '"'.$value.'",';
	}
	$graficoDados = substr($graficoDados, 0, -1).'],';
	unset($dados['descricao']);

	$dados = array_reverse($dados);

	foreach ( $dados as $key => $value) {
		$graficoDados .= '[';
		foreach ($value as $chav => $val){
			 if($chav == 0){
				$graficoDados .= '"'.$val.'",';
			}else{
				// $graficoDados .= $val.",";
				if($relatorio->idVendedor != ''){
					$graficoDados .= $val['N'].",".$val['S'].",";
				}else{
					$graficoDados .= $val.",";
				}
			}
		}
		$graficoDados = substr($graficoDados, 0, -1).'],';
	}

	$return = $varteste = '['.substr($graficoDados, 0, -1).']';
	echo json_encode($return);
}


generateAllMont($resultUser, $filters );

?>