<?php 

include_once('class.banco.php');

class Cliente{

	use Banco;

	public function cadastraCliente(
			$nomeCliente,
		    $razaoSocial,
		    $site,
		    $quantidadeImoveisLoc,
		    $quantidadeImoveisVend,
		    $telefone1,
		    $telefone2,
		    $contatoImobiliaria,
		    $funcContatoImobiliaria,
		    $email,
		    $integrador,
		    $zonaReg,
		    $cep,
		    $endereco,
		    $cidade,
		    $bairro,
		    $estado,
		    $numero,
		    $origemDados,
		    $portais,
		    $dataProposta,
		    $propostaEnviada,
		    $idVendedor
		     )
	{


		if($dataProposta == '' || $dataProposta == '--'){
			$dataProposta = date('Y-m-d');
		}else{
			$data = explode('/', $dataProposta);
			$dataProposta = $data[2].'-'.$data[1].'-'.$data[0];
		}


		$quantidadeImoveisLoc = ($quantidadeImoveisLoc == "") ? 0 : $quantidadeImoveisLoc;
		$quantidadeImoveisVend = ($quantidadeImoveisVend == "") ? 0 : $quantidadeImoveisVend;


		$sql = 'insert into clientesFuturos 
			( 
				cli_bairro,
				cli_cep,
				cli_cidade,
				cli_contato_funcao,
				cli_data_proposta,
				cli_email,
				cli_endereco,
				cli_id_status,
				cli_id_vendedor,
				cli_integrador,
				cli_nome,
				cli_nome_contato,
				cli_numero,
				cli_origem_dados,
				cli_parceiros,
				cli_proposta_enviada,
				cli_quantidade_imoveis,
				cli_quantidade_imoveis_venda,
				cli_razao,
				cli_regiao,
				cli_site,
				cli_telefone,
				cli_telefone2,
				cli_uf,
				cli_data_alteracao,
				cli_data_cadastro
			) VALUES
			( 	"'.utf8_decode($bairro).'",
			    "'.$cep.'",
			    "'.utf8_decode($cidade).'",
			    "'.utf8_decode($funcContatoImobiliaria).'",
			    "'.$dataProposta.'",
			    "'.$email.'",
			    "'.utf8_decode($endereco).'", 
			    5,
			    "'.$idVendedor.'",
			    "'.$integrador.'",
				"'.utf8_decode($nomeCliente).'",
			    "'.utf8_decode($contatoImobiliaria).'",
			    "'.$numero.'",
			    "'.utf8_decode($origemDados).'",
			    "'.utf8_decode($portais).'",
			    "'.$propostaEnviada.'",
			    "'.$quantidadeImoveisLoc.'",
			    "'.$quantidadeImoveisVend.'",
			    "'.utf8_decode($razaoSocial).'",
			    "'.utf8_decode($zonaReg).'",
			    "'.$site.'",
			    "'.$telefone1.'",
			    "'.$telefone2.'",
			    "'.$estado.'",
				NOW(),
				NOW() )';

		if($this->executaInsert($sql, 0))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function listaCliente($idVendedor = 0, $nomeFilter = 0 , $statusFilter = 0, $selectEstado = 0, $likeName = 0)
	{

		// echo $nomeFilter;
		$sql = "SELECT * FROM clientesFuturos INNER JOIN statusCliente on ( cli_id_status = sta_id ) WHERE cli_id_vendedor = ".$idVendedor;

		if(!$nomeFilter == 0 && $nomeFilter != ''){
			$sql .=	" AND cli_nome like '%".$nomeFilter."%' ";
		}		

		if(!$statusFilter == 0 && $statusFilter != '' ){
			$sql .=	" AND cli_id_status = ".$statusFilter;
		}

		if(!$selectEstado == 0 && $selectEstado != ''){
			$sql .=	" AND cli_uf = '".$selectEstado."'";
		}

		if(!$likeName == 0 && $likeName != ''){
			$sql .=	" AND cli_nome like '%".$likeName."%'";
		}

		$sql .=	" ORDER BY cli_nome ASC ";

		return $this->executaSelect($sql);
	}

	public function listaClienteGeral($nomeFilter = 0 , $statusFilter = 0, $selectEstado = 0 )
	{

		// echo $nomeFilter;
		$sql = "SELECT * FROM clientesFuturos INNER JOIN statusCliente on ( cli_id_status = sta_id ) WHERE 1=1";

		if(!$nomeFilter == 0 && $nomeFilter != ''){
			$sql .=	" AND cli_nome like '%".$nomeFilter."%' ";
		}		

		if(!$statusFilter == 0 && $statusFilter != '' ){
			$sql .=	" AND cli_id_status = ".$statusFilter;
		}

		if(!$selectEstado == 0 && $selectEstado != ''){
			$sql .=	" AND cli_uf = '".$selectEstado."'";
		}

		// if(!$likeName == 0 && $likeName != ''){
		// 	$sql .=	" AND cli_nome like '%".$likeName."%' ";
		// }

		echo $sql;

		return $this->executaSelect($sql);
	}

	public function infoCliente($idCliente)
	{
		$sql = "SELECT * FROM clientesFuturos INNER JOIN statusCliente on ( cli_id_status = sta_id ) WHERE cli_id =".$idCliente;

		return $this->executaSelect($sql);
	}

	public function atualizaCliente($idVendedor, $varIn)
	{
		echo $sql = "UPDATE clientesFuturos SET cli_id_vendedor = ".$idVendedor." WHERE cli_id in ".$varIn;
		
		return $this->executaInsert($sql);
	}


	public function listaAllCliente($nome)
	{
		$sql = "SELECT * FROM clientesFuturos WHERE cli_nome like '%".$nome."%' LIMIT 20";
		return $this->executaSelect($sql);
	}


	public function verifPhoneCliente($phone, $idNotSearch = 0)
	{

		$sql = "SELECT * FROM clientesFuturos WHERE ( cli_telefone like '%".$phone."%' OR cli_telefone2 like '%".$phone."%') ";

		if($idNotSearch > 0){
			$sql .= ' AND cli_id != '.$idNotSearch;	
 		}

 		// echo $sql;

		$result = $this->executaSelect($sql);
		// print_r($result);

		if($result){
			return utf8_encode($result[0]['cli_nome']);
		}else{
			return 0;
		}
	}


	public function atualizaStatusCliente($newStatus, $idCliente )
	{
		$sql = "UPDATE clientesFuturos SET cli_id_status = ".$newStatus." WHERE cli_id = ".$idCliente;

		return $this->executaInsert($sql);
	}


	public function atualizaFormCliente( $nomeCliente,$razaoSocial,$site,$quantidadeImoveisLoc,$quantidadeImoveisVend,$telefone1,$telefone2,$contatoImobiliaria,$funcContatoImobiliaria,$email,$integrador,$zonaReg,$cep,$endereco,$cidade,$bairro,$estado,$numero,$origemDados,$portais,$dataProposta,$propostaEnviada,$idVendedor,$idCliente ) {

		$data = explode('/', $dataProposta);
		$dataProposta = $data[2].'-'.$data[1].'-'.$data[0];

		$sql = 'UPDATE clientesFuturos SET
				cli_bairro 					= "'.utf8_decode($bairro).'",
				cli_cep 					= "'.$cep.'",
				cli_cidade 					= "'.utf8_decode($cidade).'",
				cli_contato_funcao 			= "'.utf8_decode($funcContatoImobiliaria).'",
				cli_data_proposta 			= "'.$dataProposta.'",
				cli_email 					= "'.$email.'",
				cli_endereco 				= "'.utf8_decode($endereco).'", 
				cli_integrador 				= "'.$integrador.'",
				cli_nome 					= "'.utf8_decode($nomeCliente).'",
				cli_nome_contato 			= "'.utf8_decode($contatoImobiliaria).'",
				cli_numero 					= "'.$numero.'",
				cli_origem_dados 			= "'.utf8_decode($origemDados).'",
				cli_parceiros 				= "'.utf8_decode($portais).'",
				cli_proposta_enviada 		= "'.$propostaEnviada.'",
				cli_quantidade_imoveis 		= "'.$quantidadeImoveisLoc.'",
				cli_quantidade_imoveis_venda= "'.$quantidadeImoveisVend.'",
				cli_razao 					= "'.utf8_decode($razaoSocial).'",
				cli_regiao 					= "'.utf8_decode($zonaReg).'",
				cli_site 					= "'.$site.'",
				cli_telefone 				= "'.$telefone1.'",
				cli_telefone2 				= "'.$telefone2.'",
				cli_uf 						= "'.$estado.'",
				cli_data_alteracao          = NOW() WHERE cli_id = '.$idCliente;

		// echo $sql;

		if($this->executaInsert($sql, 0))
		{
			return 1;
			// return true;
		}
		else
		{
			// echo "nao foi";
			return 0;
		}
	}

	public function listaClientePosVenda($idVendedor = 0, $nomeFilter = 0 , $statusFilter = 0, $selectEstado = 0, $likeName = 0)
	{
		// echo $nomeFilter;
		$sql = "SELECT * FROM clientesFuturos INNER JOIN statusCliente on ( cli_id_status = sta_id ) WHERE cli_id_respPos = ".$idVendedor;

		// if(!$nomeFilter == 0 && $nomeFilter != ''){
		// 	$sql .=	" AND cli_nome like '%".$nomeFilter."%' ";
		// }		

		// if(!$statusFilter == 0 && $statusFilter != '' ){
		// 	$sql .=	" AND cli_id_status = ".$statusFilter;
		// }

		// if(!$selectEstado == 0 && $selectEstado != ''){
		// 	$sql .=	" AND cli_uf = '".$selectEstado."'";
		// }

		// if(!$likeName == 0 && $likeName != ''){
		// 	$sql .=	" AND cli_nome like '%".$likeName."%'";
		// }

		$sql .=	" ORDER BY cli_nome ASC ";

		return $this->executaSelect($sql);
	}


	public function atualizaClientePosVenda() {

		$sql = 'UPDATE clientesFuturos SET';
/*				cli_bairro 					= "'.utf8_decode($bairro).'",
				cli_cep 					= "'.$cep.'",
				cli_cidade 					= "'.utf8_decode($cidade).'",
				cli_contato_funcao 			= "'.utf8_decode($funcContatoImobiliaria).'",
				cli_data_proposta 			= "'.$dataProposta.'",
				cli_email 					= "'.$email.'",
				cli_endereco 				= "'.utf8_decode($endereco).'", 
				cli_integrador 				= "'.$integrador.'",
				cli_nome 					= "'.utf8_decode($nomeCliente).'",
				cli_nome_contato 			= "'.utf8_decode($contatoImobiliaria).'",
				cli_numero 					= "'.$numero.'",
				cli_origem_dados 			= "'.utf8_decode($origemDados).'",
				cli_parceiros 				= "'.utf8_decode($portais).'",
				cli_proposta_enviada 		= "'.$propostaEnviada.'",
				cli_quantidade_imoveis 		= "'.$quantidadeImoveisLoc.'",
				cli_quantidade_imoveis_venda= "'.$quantidadeImoveisVend.'",
				cli_razao 					= "'.utf8_decode($razaoSocial).'",
				cli_regiao 					= "'.utf8_decode($zonaReg).'",
				cli_site 					= "'.$site.'",
				cli_telefone 				= "'.$telefone1.'",
				cli_telefone2 				= "'.$telefone2.'",
				cli_uf 						= "'.$estado.'",
				cli_data_alteracao          = NOW() WHERE cli_id = '.$idCliente;*/

		// echo $sql;

		// -- if($this->executaInsert($sql, 0))
		// -- {
		// -- 	return 1;
		// -- 	// return true;
		// -- }
		// -- else
		// -- {
		// -- 	// echo "nao foi";
		// -- 	return 0;
		// -- }
	}


}

?>