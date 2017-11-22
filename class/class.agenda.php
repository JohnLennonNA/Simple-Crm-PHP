<?php 
include_once('class.banco.php');

class Agenda{

	use Banco;

	public function cadastraAlerta($idVendedor,$idCliente,$titulo,$data, $hora )
	{

		$sql = 'insert into agenda 
			( age_id_vendedor, age_id_cliente, age_titulo, age_data_cadastro, age_data_aviso, age_hora_aviso, age_ativo ) VALUES
			( '.$idVendedor.', "'.$idCliente.'","'.$titulo.'", NOW(), "'.$data.'", "'.$hora.'", 1 )';

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

	public function listaEventos($idVendedor, $horaBusca, $geralDia = 0, $perfil = 0)
	{

		if($perfil != 0){
			$sql = 'SELECT * FROM gestorAtribuicoes WHERE ges_id_gestor = '.$idVendedor;
			$atribs = $this->executaSelect($sql);

			$arrayReplace = array('[',']');
			$varIn .= str_replace( $arrayReplace, '',$atribs[0]['ges_id_vendedor']).',';
		}


		$sql = "select * from agenda a inner join clientesFuturos c 
				on ( a.age_id_cliente = c.cli_id ) where ";


		if($perfil != 0 && $varIn != '[]'){
			$sql .= " age_id_vendedor in (".substr($varIn,0,-1).") AND ";
		}else{
			$sql .= " age_id_vendedor = ".$idVendedor." AND ";
		}

		$sql .=	" age_ativo = 1 AND	age_data_aviso = '".date('Y-m-d')."' ";

		if( $geralDia == 0){
			$sql .=	" AND age_hora_aviso = '".$horaBusca."' ";
		}

		$sql .= " order by age_hora_aviso asc ";

		if( $geralDia == 0){
			$sql .= " LIMIT 1 ";
		}

		// $sql = "select * from agenda a inner join clientesFuturos c 
		// 		on ( a.age_id_cliente = c.cli_id ) where 
		// 		age_id_vendedor = 9 AND 
		// 		age_ativo = 1 AND
		// 		age_data_aviso = '2015-09-24'
		// 		AND age_hora_aviso = '08:00' LIMIT 1";
		// echo $sql;
		return $this->executaSelect($sql);
	}


	public function listaEventosNextTree($idVendedor, $perfil = 0)
	{
		$de = date('Y-m-01');
		$ate = date("Y-m", strtotime("+3 month",strtotime($de)));

		if($perfil != 0){
			$sql = 'SELECT * FROM gestorAtribuicoes WHERE ges_id_gestor = '.$idVendedor;
			$atribs = $this->executaSelect($sql);

			$arrayReplace = array('[',']');
			$varIn .= str_replace( $arrayReplace, '',$atribs[0]['ges_id_vendedor']).',';

		}

		$sql = "SELECT * FROM agenda a 
				INNER JOIN    clientesFuturos c 
					ON ( a.age_id_cliente = c.cli_id ) 
				WHERE ";

		if($perfil != 0 && $varIn != '[]'){
			$sql .= " age_id_vendedor in (".substr($varIn,0,-1).") AND ";
		}else{
			$sql .= " age_id_vendedor = ".$idVendedor." AND ";
		}
				
		$sql .= " age_ativo = 1 AND	age_data_aviso >= '".$de."' AND age_data_aviso <= '".$ate."-31' ";

		return $this->executaSelect($sql);
	}



	public function atualizaEventos($idAgenda)
	{
		$sql = "SELECT * FROM agenda WHERE age_id = ".$idAgenda;
		$result = $this->executaSelect($sql);

		$dataHora = $result[0]['age_data_aviso']." ".$result[0]['age_hora_aviso'].":00";
		$newHour = date("H:i", strtotime("+1 Hour",strtotime($dataHora)));
		
		$sqlUp = "UPDATE agenda SET age_hora_aviso = '".$newHour."' WHERE age_id = ".$idAgenda;

		if($this->executaInsert($sqlUp, 0)   )
		{
			return true;
		}else{
			echo 'n funfo';
		}
	}


}

// $teste = new ClienteFuturo();
// $teste->listaCliente();

// echo 'teste';

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";