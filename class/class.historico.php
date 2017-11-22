<?php 
include_once('class.banco.php');

class Historico{

	use Banco;
	private $nome;

	// function __construct(){

	// 	$sql = "SELECT * FROM user";

	// 	echo "<pre>";
	// 	print_r($this->executaSelect($sql));
	// 	echo "</pre>";		
	// }

	public function cadastraHistorico($clienteID, $historicoConteudo, $vendedorID, $statusFeed, $tipo = 0, $statusRef = 0 )
	{
		$sql = 'insert into historico 
		( 
			his_id_cliente, 
			his_id_vendedor, 
			his_conteudo, 
			his_tipo, 
			his_decisor, 
			his_data_cadastro, 
			his_data_alteracao';
		
		if($statusRef != 0 ):
			$sql .= ',his_id_referencia';
		endif;

		$sql .= ' ) VALUES ( 
			'.$clienteID.', 
			'.$vendedorID.', 
			"'.$historicoConteudo.'", 
			"'.$tipo.'", 
			"'.$statusFeed.'", 
			NOW(), 
			NOW()';
		if($statusRef != 0 ):
			$sql .= ',"'.$statusRef.'"';
		endif;
			
		$sql .= ')';

		if($this->executaInsert($sql))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

		// echo "<pre>";
		// print_r($this->executaSelect($sql));
		// echo "</pre>";		
	}

	public function listaHistorico( $idCLiente, $inicio = 0, $fim = 0)
	{
		$sql = "SELECT *, u.nome as nomeVendedor FROM historico as h LEFT JOIN user as u on ( his_id_vendedor = u.id) 
		WHERE h.his_id_cliente = ".$idCLiente;

		if($inicio != 0 && $fim != 0 ){

			$inicio = explode("-", $inicio);
			$fim = explode("-", $fim);

			$sql .= " AND h.his_data_cadastro BETWEEN '".$inicio[2]."-".$inicio[1]."-".$inicio[0]." 00:00:00' AND '".$fim[2]."-".$fim[1]."-".$fim[0]." 23:59:59'";
		}


		$sql .= " ORDER BY his_data_cadastro DESC ";

		return $this->executaSelect($sql);
	}

}



// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";