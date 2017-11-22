<?php 
include ('class.banco.php');

class Clientes{

	use Banco;
	private $nome;

	// function __construct(){

	// 	$sql = "SELECT * FROM user";

	// 	echo "<pre>";
	// 	print_r($this->executaSelect($sql));
	// 	echo "</pre>";		
	// }

	public function cadastraCliente($idVendedor, $clienteNome, $clienteTelefone, $clienteEmail, $clienteCidade, $clienteUF )
	{

		$sql = 'insert into clientesFuturos 
			( cli_id_vendedor, cli_id_status, cli_nome, cli_telefone, cli_email,cli_cidade,cli_uf,cli_data_cadastro,cli_data_alteracao) VALUES
			( '.$idVendedor.', 1 ,"'+$clienteNome+'","'$clienteTelefone'", "'.$clienteEmail.'", "'.$clienteCidade.'", "'.$clienteUF.'", NOW(), NOW())';

		if($this->executaInsert($sql))
		{
			echo 'incluido com sucesso';
		}
		else
		{
			echo "nao incluido";
		}

		// echo "<pre>";
		// print_r($this->executaSelect($sql));
		// echo "</pre>";		
	}

	public function listaCliente($idVendedor = 0)
	{
		$sql = "SELECT * FROM clientesFuturos";

		echo "<pre>";
		print_r($this->executaSelect($sql));
		echo "</pre>";		
	}

	public function infoCliente($idCliente)
	{
		// echo $sql = "SELECT * FROM clientesFuturos WHERE cli_id =".$idCliente;

		// echo "<pre>";
		// print_r($this->executaSelect($sql));
		// echo "</pre>";		
	}


}

// $teste = new ClienteFuturo();
// $teste->listaCliente();

// echo 'teste';

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";