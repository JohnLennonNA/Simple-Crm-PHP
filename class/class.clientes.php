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

	public function cadastraCliente()
	{

		$sql = 'insert into clientesFuturos (cli_id_vendedor,cli_id_status,cli_nome,cli_telefone,cli_email,cli_cidade,cli_uf,cli_data_cadastro,cli_data_alteracao) VALUES(9,1,"Imobiliaria First Teste","(41) 0000-00000","john@john.com.br","São José dos pinhais","PR", NOW(), NOW())';

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

	public function listaCliente()
	{
		$sql = "SELECT * FROM clientesFuturos";

		echo "<pre>";
		print_r($this->executaSelect($sql));
		echo "</pre>";		
	}

}

// $teste = new Clientes();
// $teste->listaCliente();


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";