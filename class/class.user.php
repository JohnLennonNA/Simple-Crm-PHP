<?php 
include_once('class.banco.php');

class User{

	use Banco;
	public $order;
	public $filtro;
	public $idVendedor;
	public $idCliente;
	public $bairro;
	public $cidade;
	public $uf;
	public $dataDe;
	public $dataAte;
	public $perfil;
	public $status;


	public function listaUser( $idProfile, $idUser = 0 )
	{
		$sql = "SELECT * FROM user WHERE profileId > 1 AND profileId != 4 AND profileId != 5 AND is_active = 1 AND id not in (69, 70, 19, 15, 20) ";

		if($idUser != 0){
			$sql .= ' AND id = '.$idUser;
		}

		return $this->executaSelect($sql);
	}

	public function listaUserGrafico( $idProfile, $idUser = 0 )
	{
		$sql = "SELECT user.id,user.nome FROM user INNER JOIN historico on (user.id = historico.his_id_vendedor)
		WHERE profileId > 1 AND profileId != 4 AND profileId != 5 AND is_active = 1 AND id not in (69, 70,19,15,20)";

		if($idUser != 0){
			$sql .= ' AND id = '.$idUser;
		}

		$sql .= ' group by user.id ';

		// echo $sql;

		return $this->executaSelect($sql);
	}

	public function listaUserAtribuicoes($idGestor = 0)
	{
		$varIn = '';

		if($idGestor == 0 ){
			
			$condicao = 'not in';

			$sql = 'SELECT * FROM gestorAtribuicoes';
			$atribs = $this->executaSelect($sql);

			foreach ($atribs as $key => $value){
				// echo $value['ges_id_vendedor'];
				if($value['ges_id_vendedor'] != "[]"){
					$arrayReplace = array('[',']');
					$varIn .= str_replace( $arrayReplace, '', $value['ges_id_vendedor']).',';
				}
			}

		}else{
			$condicao = 'in';

			$sql = 'SELECT * FROM gestorAtribuicoes WHERE ges_id_gestor = '.$idGestor;
			$atribs = $this->executaSelect($sql);

			foreach ($atribs as $key => $value){
				if($value['ges_id_vendedor'] != "[]"){
					$arrayReplace = array('[',']');
					$varIn .= str_replace( $arrayReplace, '', $value['ges_id_vendedor']).',';
				}
			}
		}

		if(empty($varIn) || $varIn == ',' ){
			$varIn = '0,';
		}

		$sql = 'SELECT * FROM user WHERE is_active = 1 AND profileid != 5 AND id '.$condicao.' ('.substr($varIn, 0, -1).') order by nome asc '; 
		return $this->executaSelect($sql);

		// echo $sql;

		// if($result[]){
		// 	return $this->executaSelect($sql);
		// }else{
		// 	return false;
		// }
	} 


	// public function listaUserChart( $idProfile )
	// {
	// 	$sql = "SELECT * FROM user WHERE profileId = ".$idProfile." AND is_active = 1";

	// 	return $this->executaSelect($sql);
	// }


}



// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";