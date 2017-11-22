<?php

include("../class/class.cliente.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$cliente = new Cliente();

if($_GET['action'] == 'buscaFiltro'){

	if ( $_GET['userProfile'] != 1 && $_GET['userProfile'] != 4 ){
		$result = $cliente->listaCliente($_GET['vendedorInicial'], $_GET['nomeFilter'], $_GET['statusFilter'], $_GET['estadoFilter']);
	}else{
		$result = $cliente->listaClienteGeral( $_GET['nomeFilter'], $_GET['statusFilter'], $_GET['estadoFilter'] );
	}

	// if ( $_GET['userProfile'] != 1 && $_GET['userProfile'] != 4 && $_GET['userProfile'] != 8 ){
	// 	$result = $cliente->listaCliente($_GET['vendedorInicial'], $_GET['nomeFilter'], $_GET['statusFilter'], $_GET['estadoFilter']);
	// // }else if( $_GET['userProfile'] == 4 || $_GET['userProfile'] == 8 ){
	// }else if( $_GET['userProfile'] == 8 ){
	// 	$result = $cliente->listaClientePosVenda($_GET['vendedorInicial'], $_GET['nomeFilter'], $_GET['statusFilter'], $_GET['estadoFilter']);
	// }else{
	// 	$result = $cliente->listaClienteGeral( $_GET['nomeFilter'], $_GET['statusFilter'], $_GET['estadoFilter'] );
	// }

}
else{
	$result = $cliente->listaCliente($_GET['vendedorInicial']);
}

if(count($result) > 0 ){
	foreach ($result as $key => $value) {

		echo '<tr idCLiente="'.$value['cli_id'].'" class="linhaCliente ClienteLista'.$value['cli_id'].'">
			<td>'.utf8_encode($value['cli_nome']).'</td>
			<td>'.$value['cli_quantidade_imoveis'].'</td>
			<td><a title="'.utf8_encode($value['sta_nome']).'">'.$value['sta_referencia'].'</a></td>
			<td>
				<button idCliente="'.$value['cli_id'].'" class="btn btn-xs btn-success atendimentoCliente">
					<i class="ace-icon fa fa-phone bigger-120"></i>
				</button>

				<a href="cadastroClientes.php?idCliente='.$value['cli_id'].'" class="btn btn-xs btn-info">
					<i class="ace-icon fa fa-pencil bigger-120"></i>
				</a>';

				if( $_GET['userProfile'] == 4 || $_GET['userProfile'] == 8 ){

					if( $value['cli_id_refCms'] > 0 ){
						echo '<button idCliente="'.$value['cli_id'].'" class="btn btn-xs btn-danger">
							<i class="fa fa-bar-chart"></i>
						</button>';
					}else{
						echo '<button idCliente="'.$value['cli_id'].'" class="btn btn-xs btn-warning refCms">
							<i class="ace-icon fa fa-exchange"></i>
						</button>';
					}
				}
			echo '</td>
		</tr>';
	}
}else{
	echo "'<tr><td class='text-center' colspan='4'>Nao foram encontrados clientes para listagem</td></tr>";
}
?>