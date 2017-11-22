<?php 

include_once('class.banco.php');

class Relatorio{

	use Banco;
	public $totalReg;
	public $pagina;
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
	
	function __construct(){
		$this->totalReg = 10;
		$this->pagina = 0;
		$this->order = '';
		$this->filtro = 0;
		$this->idVendedor = '';
		$this->idCliente = '';
		$this->bairro = '';
		$this->cidade = '';
		$this->uf = '';
		$this->dataDe = '';
		$this->dataAte = '';
		$this->perfil = '';
	}


	public function geralClientes($idVendedor = false, $idGestor = false)
	{
		$sql = 'select count(*) as total from clientesFuturos';

		return $this->executaSelect($sql);
	}


	// Busca a lista de imobiliarias e quantidade de imóveis
	public function qtdImoveisImobiliarias()
	{
		$sql = 'select count(*) as qtdImobiliarias, sum(c.cli_quantidade_imoveis) as qtdImoveis, u.nome from 
									clientesFuturos c INNER JOIN 
									user u on ( u.id = c.cli_id_vendedor)  
									WHERE cli_id_vendedor != 0 group by c.cli_id_vendedor';

		return $this->executaSelect($sql);
	}


	public function resumoGeralClientes($idVendedor)
	{
		$sql = 'select count(*) as total, cli_uf from clientesFuturos where cli_id_vendedor = '.$idVendedor.' group by cli_uf';

		return $this->executaSelect($sql);
	}


	// Busca a lista de clientes e agrupa por status
	// Definindo a quantidade por referencia
	public function quantidadeCLientesPorStatus()
	{
		$sql = 'select count(*) as total, s.sta_nome, s.sta_referencia, sta_id, sta_status 
				FROM clientesFuturos c 
				INNER JOIN statusCliente s ON ( c.cli_id_status = s.sta_id ) ';

			// $sql = 'select count(*) as total, s.sta_referencia, his_id, left(s.sta_referencia, 2) as sta_status
			// 	FROM historico h 
			// 	INNER JOIN statusCliente s ON ( h.his_id_referencia = s.sta_referencia )
			// 	INNER JOIN clientesFuturos c ON ( h.his_id_cliente = c.cli_id )
			// 	';
	  //       $sql .= ' WHERE h.his_tipo = 1 ';

			// $sql .= ' WHERE ';			

	        if($this->filtro == 1){

				// if( $this->dataDe != '' && $this->dataAte != '' ){
				// 	$sql .= ' AND h.his_data_cadastro BETWEEN "'.$this->dataDe.' 00:00:00" AND "'.$this->dataAte.' 23:59:59" ';
				// }

				if( $this->uf != '' ){
					$sql .= ' AND c.cli_uf = "'.$this->uf.'" ';
				}

				if( $this->cidade != '' ){
					$sql .= ' AND c.cli_cidade = "'.$this->cidade.'" ';
				}

				if( $this->bairro != '' ){
					$sql .= ' AND c.cli_bairro = "'.$this->bairro.'" ';
				}

				if( $this->idVendedor != '' ){
					$sql .= ' AND c.cli_id_vendedor = "'.$this->idVendedor.'" ';
				}

				if( $this->idCliente != '' ){
					$sql .= ' AND c.cli_id = "'.$this->idCliente.'" ';
				}

				if( $this->status != '' ){
					$sql .= ' AND c.cli_id_status = "'.$this->status.'" ';
				}

	        }

			
			$sql .= ' AND c.cli_id_vendedor != 0';


			$sql .=	' group by s.sta_referencia ';

			// echo $sql;

			return $this->executaSelect($sql);
	}


	public function historicoSemStatus()
	{
		// $sql = 'select count(*) as total, s.sta_nome, s.sta_referencia, sta_id, sta_status 
		// 		FROM clientesFuturos c 
		// 		INNER JOIN statusCliente s ON ( c.cli_id_status = s.sta_id ) group by s.sta_referencia';

			$sql = 'select count(*) as total, his_id FROM historico h INNER JOIN clientesFuturos c ON ( h.his_id_cliente = c.cli_id ) ';
	        $sql .= ' WHERE h.his_tipo = 0 ';

	        if($this->filtro == 1){

				if( $this->dataDe != '' && $this->dataAte != '' ){
					$sql .= ' AND h.his_data_cadastro BETWEEN "'.$this->dataDe.' 00:00:00" AND "'.$this->dataAte.' 23:59:59" ';
				}

				if( $this->uf != '' ){
					$sql .= ' AND c.cli_uf = "'.$this->uf.'" ';
				}

				if( $this->cidade != '' ){
					$sql .= ' AND c.cli_cidade = "'.$this->cidade.'" ';
				}

				if( $this->bairro != '' ){
					$sql .= ' AND c.cli_bairro = "'.$this->bairro.'" ';
				}

				if( $this->idVendedor != '' ){
					$sql .= ' AND c.cli_id_vendedor = "'.$this->idVendedor.'" ';
				}

				if( $this->idCliente != '' ){
					$sql .= ' AND c.cli_id = "'.$this->idCliente.'" ';
				}

				// if( $this->status != '' ){
				// 	$sql .= ' AND c.cli_id_status = "'.$this->status.'" ';
				// }

	        }

			// $sql .=	' group by s.sta_referencia ';

			// echo $sql;

			return $this->executaSelect($sql);
	}




	// Traz a lista de clientes geral ou por filtro
	public function ListagemClientes($tabelaPorcentagem = 0)
	{

		if ($this->pagina == 0)
		{ 
			$pc = "1"; 
		}else{ 
			$pc = $this->pagina; 
		}

		$inicio = $pc - 1; 
		$inicio = $inicio * $this->totalReg;
	
 		$sql = 'SELECT
				c.cli_id, 
				cli_data_cadastro, 
				c.cli_nome, 
				cli_quantidade_imoveis, 
				cli_cidade, 
				cli_uf, 
				c.cli_telefone, 
				c.cli_telefone2, 
				c.cli_nome_contato, 
				c.cli_site, 
				h.his_conteudo, 
				h.his_data_cadastro, 
				h.his_id_vendedor,
				h.his_decisor, 
				s.sta_referencia, 
				u.nome 
				FROM clientesFuturos c 
				LEFT JOIN user u on (c.cli_id_vendedor = u.id) 
				LEFT JOIN statusCliente s on (c.cli_id_status = s.sta_id) 
				LEFT JOIN ( select * from historico where his_tipo = 0 GROUP BY his_id_cliente ORDER BY historico.his_id_cliente DESC ) as h on (c.cli_id = h.his_id_cliente )';


        if($this->filtro == 1){
        	$sql .= ' WHERE c.cli_id != "" ';

			if( $this->dataDe != '' && $this->dataAte != '' ){
				$sql .= ' AND h.his_data_cadastro BETWEEN "'.$this->dataDe.' 00:00:00" AND "'.$this->dataAte.' 23:59:59" ';
			}

			if( $this->uf != '' ){
				$sql .= ' AND c.cli_uf = "'.$this->uf.'" ';
			}

			if( $this->cidade != '' ){
				$sql .= ' AND c.cli_cidade = "'.$this->cidade.'" ';
			}

			if( $this->bairro != '' ){
				$sql .= ' AND c.cli_bairro = "'.$this->bairro.'" ';
			}

			if( $this->idVendedor != '' ){
				$sql .= ' AND c.cli_id_vendedor = "'.$this->idVendedor.'" ';
			}

			if( $this->idCliente != '' ){
				$sql .= ' AND c.cli_id = "'.$this->idCliente.'" ';
			}

			if( $this->status != '' ){
				$sql .= ' AND c.cli_id_status = "'.$this->status.'" ';
			}
        }

		if($tabelaPorcentagem == 0){
			$sql .= ' ORDER BY h.his_data_cadastro desc, c.cli_nome asc LIMIT '.$inicio.','.$this->totalReg;  
        }else if($tabelaPorcentagem == 3){
        	$sql .= ' ORDER BY h.his_data_cadastro desc, c.cli_nome asc ';  
        }

   //      if($tabelaPorcentagem == 0){
			// $sql .= ' group by c.cli_id ORDER BY h.his_data_cadastro desc LIMIT '.$inicio.','.$this->totalReg;  
   //      }else if($tabelaPorcentagem == 3){
   //      	$sql .= ' group by c.cli_id ORDER BY h.his_data_cadastro desc ';  
   //      }

        // echo $sql;

		return $this->executaSelect($sql);
	}

	// Auxilia na paginacao dos clientes.
	public function paginacaoListagemClientes()
	{
		// $sql = 'SELECT 
		// 		c.cli_id, 
		// 		c.cli_data_cadastro, 
		// 		c.cli_nome, 
		// 		c.cli_quantidade_imoveis, 
		// 		c.cli_cidade, 
		// 		c.cli_uf, 
		// 		c.cli_telefone, 
		// 		c.cli_telefone2, 
		// 		c.cli_nome_contato, 
		// 		c.cli_site, 
		// 		h.his_conteudo, 
		// 		h.his_data_cadastro,
		// 		s.sta_referencia, 
		// 		u.nome
		// 		-- count(*) qtdHistorico
		// 		FROM clientesFuturos c
		// 		LEFT JOIN user u on (c.cli_id_vendedor = u.id)
		// 		LEFT JOIN statusCliente s on (c.cli_id_status = s.sta_id)
		// 		LEFT JOIN historico as h on (c.cli_id = h.his_id_cliente and his_tipo = 0)';
 		$sql = 'SELECT
				c.cli_id, 
				cli_data_cadastro, 
				c.cli_nome, 
				cli_quantidade_imoveis, 
				cli_cidade, 
				cli_uf, 
				c.cli_telefone, 
				c.cli_telefone2, 
				c.cli_nome_contato, 
				c.cli_site, 
				h.his_conteudo, 
				h.his_data_cadastro, 
				h.his_id_vendedor, 
				s.sta_referencia, 
				u.nome 
				FROM clientesFuturos c 
				LEFT JOIN user u on (c.cli_id_vendedor = u.id) 
				LEFT JOIN statusCliente s on (c.cli_id_status = s.sta_id) 
				LEFT JOIN ( select * from historico where his_tipo = 0 GROUP BY his_id_cliente ORDER BY historico.his_id_cliente DESC ) as h on (c.cli_id = h.his_id_cliente )';

		        if($this->filtro == 1){
		        	$sql .= ' WHERE c.cli_id != "" ';

					if( $this->dataDe != '' && $this->dataAte != '' ){
						$sql .= ' AND h.his_data_cadastro BETWEEN "'.$this->dataDe.' 00:00:00" AND "'.$this->dataAte.' 23:59:59" ';
					}

					if( $this->uf != '' ){
						$sql .= ' AND c.cli_uf = "'.$this->uf.'" ';
					}

					if( $this->cidade != '' ){
						$sql .= ' AND c.cli_cidade = "'.$this->cidade.'" ';
					}

					if( $this->bairro != '' ){
						$sql .= ' AND c.cli_bairro = "'.$this->bairro.'" ';
					}

					if( $this->idVendedor != '' ){
						$sql .= ' AND c.cli_id_vendedor = "'.$this->idVendedor.'" ';
					}

					if( $this->idCliente != '' ){
						$sql .= ' AND c.cli_id = "'.$this->idCliente.'" ';
					}

					if( $this->status != '' ){
						$sql .= ' AND c.cli_id_status = "'.$this->status.'" ';
					}

		        }

        // $sql .= ' group by c.cli_id';


        // echo $sql;

		$result['total'] = $this->executaSelect($sql, 1);
		$result['numPaginas'] = ceil( $result['total'] / $this->totalReg );

		return $result;
	}

	public function buscaBairros($nomeBairro){

		$sql = "SELECT * FROM clientesFuturos WHERE cli_bairro like '%".$nomeBairro."%' group by cli_bairro";

		return $this->executaSelect($sql);
	}

	public function buscaCidades($nomeCidade){

		$sql = "SELECT * FROM clientesFuturos WHERE cli_cidade like '%".$nomeCidade."%' group by cli_cidade";

		return $this->executaSelect($sql);
	}


	public function buscaVendedores($nomeVendedor){

		$sql = "SELECT * FROM user WHERE nome like '%".$nomeVendedor."%' group by nome";

		return $this->executaSelect($sql);
	}


	public function resumoGeralVendedores($idVendedor, $uf){
		$sql = "select count(*) as total, c.cli_uf from clientesFuturos as c where c.cli_uf = '".$uf."' AND c.cli_id_vendedor = ".$idVendedor;

		if( $this->cidade != '' ){
			$sql .= ' AND c.cli_cidade = "'.$this->cidade.'" ';
		}

		if( $this->bairro != '' ){
			$sql .= ' AND c.cli_bairro = "'.$this->bairro.'" ';
		}

		if( $this->idCliente != '' ){
			$sql .= ' AND c.cli_id = "'.$this->idCliente.'" ';
		}

		if( $this->status != '' ){
			$sql .= ' AND c.cli_id_status = "'.$this->status.'" ';
		}

		$sql .= ' group by cli_uf ';

		echo $sql.'<br>';

		return $this->executaSelect($sql);
	}

	public function resumoGeralVendedoresV2($idVendedor = 0 ){
		
		$sql = "select count(*) as total, c.cli_uf, u.id, u.nome from clientesFuturos as c 
				INNER JOIN user as u on (c.cli_id_vendedor = u.id ) ";

		if($idVendedor != 0){
			$sql .= " where c.cli_id_vendedor = ".$idVendedor;
		}

		$sql .= " group by c.cli_id_vendedor, c.cli_uf ";

		// echo $sql;

		return $this->executaSelect($sql);
	}

	public function resumoGeralDistinctUf($idVendedor = 0 ){
		$sql = "SELECT DISTINCT cli_uf from clientesFuturos";
		return $this->executaSelect($sql);
	}

	public function listaEstadosResumo(){
		$sql = "select cli_uf from clientesFuturos ";

		$sql .= ' group by cli_uf ';

		return $this->executaSelect($sql);
	}

	public function countHistoricoCLiente($idCliente){
			$sql =	"SELECT count(*) as qtdHistorico from historico where his_id_cliente = ".$idCliente." and his_tipo = 0";
			return $this->executaSelect($sql);
	}

	public function buscaImobiliarias($nomeImobiliarias){

		$sql = "SELECT * FROM clientesFuturos WHERE cli_nome like '%".$nomeImobiliarias."%' group by cli_nome";

		return $this->executaSelect($sql);
	}


	// REMOVER ESTE METODO
	public function geraDadosGrafico($mes, $idVendedor, $profileID = 0){
		$sql = "SELECT count(*) as total from historico 
				LEFT JOIN clientesFuturos on (his_id_cliente = cli_id )
		where "; 

		$sql .= " his_id_vendedor = '".$idVendedor."' ";
		

		if( !empty($this->idCliente)){
			$sql .= " AND his_id_cliente = '".$this->idCliente."' ";
		}

		if( !empty($this->cidade)){
			$sql .= " AND cli_cidade like '%".$this->cidade."%' ";
		}

		if( !empty($this->uf)){
			$sql .= " AND cli_uf = '".$this->uf."' ";
		}

		if( !empty($this->status)){
			$sql .= " AND cli_id_status = '".$this->status."' ";
		}

		if(str_replace('-', '', $mes) > 201603 ){
			$sql .= " AND his_data_cadastro between '".$mes."-01 00:00:00' AND '".$mes."-31 23:59:59' and his_tipo = 0 ";
			$sql .= " AND his_decisor = 'S' ";
		}else{
			$sql .= " AND his_data_cadastro between '".$mes."-01 00:00:00' AND '".$mes."-31 23:59:59' and his_tipo = 0 ";
		}

		
		// echo $sql;
		// echo "<br><br>";

		return $this->executaSelect($sql);
	}

	// REMOVER METODO
	public function geraDadosGraficoDays($data, $idVendedor, $profileID = 0){
		$sql = "SELECT count(*) as total from historico 
				LEFT JOIN clientesFuturos on (his_id_cliente = cli_id )
		where "; 

		$sql .= " his_id_vendedor = '".$idVendedor."' ";
		// $sql .= " AND his_decisor = 'S' ";

		if( !empty($this->idCliente)){
			$sql .= " AND his_id_cliente = '".$this->idCliente."' ";
		}

		if( !empty($this->cidade)){
			$sql .= " AND cli_cidade like '%".$this->cidade."%' ";
		}

		if( !empty($this->uf)){
			$sql .= " AND cli_uf = '".$this->uf."' ";
		}

		if( !empty($this->status)){
			$sql .= " AND cli_id_status = '".$this->status."' ";
		}

		if(str_replace('-', '', $data) >= 20160328 ){
			$sql .= " AND his_data_cadastro between '".$data." 00:00:00' AND '".$data." 23:59:59' and his_tipo = 0 ";
			$sql .= " AND his_decisor = 'S' ";
		}else{
			$sql .= " AND his_data_cadastro between '".$data." 00:00:00' AND '".$data." 23:59:59' and his_tipo = 0 ";
		}

		echo $sql;

		return $this->executaSelect($sql);
	}



	public function generateDataMonths($data, $idVendedor, $columnKey = 1 ){
		$sql = "SELECT count(*) as total from historico 
				LEFT JOIN clientesFuturos on (his_id_cliente = cli_id )
		where "; 

		$sql .= " his_id_vendedor = '".$idVendedor."' ";

		if( !empty($this->idCliente)){
			$sql .= " AND his_id_cliente = '".$this->idCliente."' ";
		}

		if( !empty($this->cidade)){
			$sql .= " AND cli_cidade like '%".$this->cidade."%' ";
		}

		if( !empty($this->uf)){
			$sql .= " AND cli_uf = '".$this->uf."' ";
		}

		if( !empty($this->status)){
			$sql .= " AND cli_id_status = '".$this->status."' ";
		}
		
		$sql .= " AND his_data_cadastro between '".$data."-01 00:00:00' AND '".$data."-31 23:59:59' and his_tipo = 0 ";

		if($columnKey == 2){
			$sql .= " group by his_decisor";
		}else{
			if(str_replace('-', '', $data) >= 201604){
				$sql .= " AND his_decisor = 'S'";
			}
		}

		// echo $sql;

		return $this->executaSelect($sql);
	}

	public function generateDataDays($data, $idVendedor, $columnKey = 1 ){
		$sql = "SELECT count(*) as total from historico 
				LEFT JOIN clientesFuturos on (his_id_cliente = cli_id )
		where "; 

		$sql .= " his_id_vendedor = '".$idVendedor."' ";
		if( !empty($this->idCliente)){
			$sql .= " AND his_id_cliente = '".$this->idCliente."' ";
		}

		if( !empty($this->cidade)){
			$sql .= " AND cli_cidade like '%".$this->cidade."%' ";
		}

		if( !empty($this->uf)){
			$sql .= " AND cli_uf = '".$this->uf."' ";
		}

		if( !empty($this->status)){
			$sql .= " AND cli_id_status = '".$this->status."' ";
		}

		$sql .= " AND his_data_cadastro between '".$data." 00:00:00' AND '".$data." 23:59:59' and his_tipo = 0 ";
		
		if($columnKey == 2){
			$sql .= " group by his_decisor";
		}else{
			if(str_replace('-', '', $data) >= 20160401){
				$sql .= " AND his_decisor = 'S'";
			}
		}

		// echo $sql.'\n\n';
		return $this->executaSelect($sql);
	}


}