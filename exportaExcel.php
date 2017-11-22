<?php 
   // header('Content-Type: text/html; charset=utf-8');
   header("Content-type: application/vnd.ms-excel");  
   header("Content-type: application/force-download"); 
   header("Content-Disposition: attachment; filename=file.xls");
   header("Pragma: no-cache");

	include_once("class/class.relatorios.php");
	// echo "<pre>";
	// print_r($_GET);
	// echo "</pre>";
	$relatorio = new Relatorio();

	// 	FILTROS BUSCA
		$slug = '';

		if (isset($_GET['p']) && $_GET['p'] != ''){

		  	$relatorio->pagina = $_GET['p'];
		}

		if ( ( isset($_GET['dataDe']) && $_GET['dataDe'] != '') && ( isset($_GET['dataAte']) && $_GET['dataAte'] != '') ){
			$relatorio->filtro = 1;
		  	$relatorio->dataDe = $_GET['dataDe'];
		  	$relatorio->dataAte = $_GET['dataAte'];
		  	$slug .= '&dataDe='.$relatorio->dataDe;
		  	$slug .= '&dataAte='.$relatorio->dataAte;
		}

		if ( !empty($_GET['uf']) ){
			$relatorio->filtro = 1;
			$relatorio->uf = $_GET['uf'];
			$slug .= '&uf='.$relatorio->uf;
		}

		if ( !empty($_GET['cidade']) && !empty($_GET['cidade']) ){
			$relatorio->filtro = 1;
			$relatorio->cidade = $_GET['cidade'];
			$slug .= '&cidade='.$relatorio->cidade;
		}

		if ( !empty($_GET['bairro']) ){
			$relatorio->filtro = 1;
			$relatorio->bairro = $_GET['bairro'];
			$slug .= '&bairro='.$relatorio->bairro;
		}

		if ( !empty($_GET['idVendedor']) ){
			$relatorio->filtro = 1;
			$relatorio->idVendedor = $_GET['idVendedor'];
			$slug .= '&idVendedor='.$relatorio->idVendedor;
		}

		if ( $_SESSION['_sf2_attributes']['profileUser'] == 2 ){
			$relatorio->filtro = 1;
			$relatorio->idVendedor = $_SESSION['_sf2_attributes']['idUser'];
			$slug .= '&idVendedor='.$relatorio->idVendedor;
		}

		if ( !empty($_GET['idImobiliaria']) ){
			$relatorio->filtro = 1;
			$relatorio->idCliente = $_GET['idImobiliaria'];
			$slug .= '&idImobiliaria='.$relatorio->idCliente;
		}

		if ( !empty($_GET['statusFilter']) ){
			$relatorio->filtro = 1;
			$relatorio->status = $_GET['statusFilter'];
			$slug .= '&statusFilter='.$relatorio->status;
		}
	// 	FIM FILTROS BUSCA

   // echo $html;
?>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><?=mb_convert_encoding("Data Inclusão", 'UTF-16LE', 'UTF-8');?></th>
			<th>Nome Vendedor</th>
			<th><?=mb_convert_encoding("Nome Imobiliária", 'UTF-16LE', 'UTF-8');?></th>
			<th>Status</th>
			<th><?=mb_convert_encoding("Imóveis Locação", 'UTF-16LE', 'UTF-8');?></th>
			<th>Cidade</th>
			<th>UF</th>
			<th>Contato</th>
			<th><?=mb_convert_encoding("Nº Contat.", 'UTF-16LE', 'UTF-8');?></th>
			<th>Data Ultimo Histor.</th>
			<th><?=mb_convert_encoding("Ultimo Histórico", 'UTF-16LE', 'UTF-8');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$resultListagem = $relatorio->ListagemClientes(3);
		foreach ($resultListagem as $key => $value){ ?>
			<tr>
				<td class="center"><?=date('d/m/Y', strtotime($value['cli_data_cadastro']))?></td>
				<td class="center">
					<?php 
						$vendedor = ($value['nome'] == '')? 'Não Atribuido' : utf8_encode($value['nome']);   
						echo mb_convert_encoding($vendedor, 'UTF-16LE', 'UTF-8');
					?></td>

				<td class="center"><?=$value['cli_nome'];?></td>
				<td class="center"><?=utf8_encode($value['sta_referencia']);?></td>
				<td class="center"><?=$value['cli_quantidade_imoveis']?></td>
				<td class="center"><?=mb_convert_encoding($value['cli_cidade'], 'UTF-16LE', 'UTF-8');?></td>
				<td class="center"><?=$value['cli_uf']?></td>
				<td class="center"><?=$value['cli_nome_contato']?></td>
				<td class="center"><?=$value['qtdHistorico']?></td>
				<td class="center"><?=( date('d/m/Y', strtotime($value['his_data_cadastro'])) == '31/12/1969' )? "--": date('d/m/Y', strtotime($value['his_data_cadastro'])); ?></td>
				<td class="center"><?=mb_convert_encoding($value['his_conteudo'], 'UTF-16LE', 'UTF-8');?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

