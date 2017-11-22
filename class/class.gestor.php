<?php 
include ('class.banco.php');
// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);
class Gestor{

	use Banco;

	public function verificaGestor($idGestor){

		$sql = 'SELECT * FROM gestorAtribuicoes WHERE ges_id_gestor = '.$idGestor;

		return $this->executaSelect($sql, 1);
	}


	public function insereGestor($idGestor, $idVendedores){
		$sql = 'INSERT INTO gestorAtribuicoes (ges_id_gestor, ges_id_vendedor) VALUES ('.$idGestor.', "'.$idVendedores.'" )';
		// echo $sql;
		return $this->executaInsert($sql);
	}

	public function atualizaGestor($idGestor, $idVendedores)
	{

		$sql = 'SELECT * FROM gestorAtribuicoes WHERE ges_id_gestor = '.$idGestor;
		$result = $this->executaSelect($sql);

		$arrayReplace = array('[',']');

		$varIn = str_replace( $arrayReplace, '', $result[0]['ges_id_vendedor']);
		$varInConcat = str_replace( $arrayReplace, '', $idVendedores);

		if( $varIn == ''){
			$idVendedores = '['.$varInConcat.']';
		}else{
			$idVendedores = '['.$varIn.','.$varInConcat.']';
		}

		$sql = 'UPDATE gestorAtribuicoes SET ges_id_vendedor = "'.$idVendedores.'" WHERE ges_id_gestor = '.$idGestor; 

		return $this->executaInsert($sql);
	} 

	public function removeVendedor($idGestor, $idVendedores){
		
		$sql = 'SELECT * FROM gestorAtribuicoes WHERE ges_id_gestor = '.$idGestor;
		$result = $this->executaSelect($sql);


		$array1 = json_decode($result[0]['ges_id_vendedor']);
		$array2 = json_decode($idVendedores);

		$resposta = array_diff($array1, $array2);

		$varIn = '';

		foreach ($resposta as $key => $value) {
			$varIn .= $value.',';
		}

		$idVendedores = '['.substr($varIn, 0, -1 ).']';

		$sql = 'UPDATE gestorAtribuicoes SET ges_id_vendedor = "'.$idVendedores.'" WHERE ges_id_gestor = '.$idGestor; 

		return $this->executaInsert($sql);
	}




}
