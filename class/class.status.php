<?php 
include_once('class.banco.php');

class Status{

	use Banco;

	public function cadastraStatus($clienteID, $historicoConteudo, $vendedorID )
	{
		// $sql = 'insert into historico ( his_id_cliente, his_id_vendedor, his_conteudo, his_data_cadastro, his_data_alteracao ) VALUES ( 
		// 	'.$clienteID.', '.$vendedorID.', "'.$historicoConteudo.'", NOW(), NOW())';

		// if($this->executaInsert($sql))
		// {
		// 	echo 1;
		// }
		// else
		// {
		// 	echo 0;
		// }

		// echo "<pre>";
		// print_r($this->executaSelect($sql));
		// echo "</pre>";		
	}

	public function listaStatus($idStatus = 0)
	{
		$sql = "SELECT * FROM statusCliente";

		if($idStatus > 0){
			$sql .= " WHERE sta_id = ".$idStatus;
		}

		$sql .= " ORDER BY sta_referencia ASC";

		return $this->executaSelect($sql);

	}

}



// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";