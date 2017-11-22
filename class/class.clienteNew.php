<?php 
include ('class.banco.php');

class ClienteNew{

	use Banco;

	public function listaCliente( $idProfile )
	{
		$sql = "SELECT * FROM user WHERE profileId = ".$idProfile;

		return $this->executaSelect($sql);

	}

}

?>