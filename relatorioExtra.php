<?php 
	include ("includes/header.php");
	include_once("class/class.status.php");
	include_once("class/class.relatorios.php");
	include_once("class/class.user.php");
	 include_once("class/class.status.php");


// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

    	// $teste = new Relatorio();
		// $testeres = $teste->quantidadeCLientesPorStatus();
		// echo "<pre>";
		// print_r($_SESSION);
		// echo "</pre>";

		$status = new Status();
		$relatorio = new Relatorio();
		$user = new User();
		$parameterRelAjax = [];

		// 	FILTROS BUSCA
			$slug = '';

			if (isset($_GET['p']) && $_GET['p'] != ''){
			  	$relatorio->pagina = $_GET['p'];
			}

			if ( ( isset($_GET['dataDe']) && $_GET['dataDe'] != '') && ( isset($_GET['dataAte']) && $_GET['dataAte'] != '') ){
				$relatorio->filtro = 1;
			  	$relatorio->dataDe = $_GET['dataDe'];
			  	$relatorio->dataAte = $_GET['dataAte'];
			  	// $slug .= '&dataDe='.$relatorio->dataDe;
			  	// $slug .= '&dataAte='.$relatorio->dataAte;
			}

			if ( !empty($_GET['uf']) ){
				$relatorio->filtro = 1;
				$relatorio->uf = $_GET['uf'];
				
				$parameterRelAjax['uf'] = $_GET['uf'];

				// $slug .= '&uf='.$relatorio->uf;
			}

			if ( !empty($_GET['cidade']) && !empty($_GET['cidade']) ){
				$relatorio->filtro = 1;
				$relatorio->cidade = $_GET['cidade'];

				$parameterRelAjax['cidade'] = $_GET['cidade'];

				// $slug .= '&cidade='.$relatorio->cidade;
			}

			if ( !empty($_GET['bairro']) ){
				$relatorio->filtro = 1;
				$relatorio->bairro = $_GET['bairro'];
				// $slug .= '&bairro='.$relatorio->bairro;
			}

			// if ( !empty($_GET['idVendedor']) || $_GET['idVendedor'] === 0 ){
			if ( $_GET['idVendedor'] != ''){
				// echo "Entro no vendedor".$_GET['idVendedor'];
				$relatorio->filtro = 1;
				$relatorio->idVendedor = $_GET['idVendedor'];

				$parameterRelAjax['idVendedor'] = $_GET['idVendedor'];

				// $slug .= '&idVendedor='.$relatorio->idVendedor;
			}

			if ( $_SESSION['_sf2_attributes']['profileUser'] == 2  || $_SESSION['_sf2_attributes']['profileUser'] >= 7 ){
				$relatorio->filtro = 1;
				$relatorio->idVendedor = $_SESSION['_sf2_attributes']['idUser'];

				$parameterRelAjax['idVendedor'] = $_SESSION['_sf2_attributes']['idUser'];

				$slug .= '&idVendedor='.$relatorio->idVendedor;
			}

			if ( !empty($_GET['idImobiliaria']) ){
				$relatorio->filtro = 1;
				$relatorio->idCliente = $_GET['idImobiliaria'];
				
				$parameterRelAjax['idCliente'] = $_GET['idImobiliaria'];

				// $slug .= '&idImobiliaria='.$relatorio->idCliente;
			}

			if ( !empty($_GET['statusFilter']) ){
				$relatorio->filtro = 1;
				$relatorio->status = $_GET['statusFilter'];

				$parameterRelAjax['status'] = $_GET['statusFilter'];

				// $slug .= '&statusFilter='.$relatorio->status;
			}

			if( $_SESSION['_sf2_attributes']['profileUser'] == 2 || $_SESSION['_sf2_attributes']['profileUser'] >= 7 || !empty($_GET['idVendedor']) ){
				if(!empty($_GET['idVendedor'])){				
					$resultUser = $user->listaUser(2,$_GET['idVendedor']);
					$resultUserGrafico = $user->listaUserGrafico(2,$_GET['idVendedor']);
				}else{
					$resultUser = $user->listaUser(2,$_SESSION['_sf2_attributes']['idUser']);
					$resultUserGrafico = $user->listaUserGrafico(2,$_SESSION['_sf2_attributes']['idUser']);
				}
			}else{	
				$resultUser = $user->listaUser(2);
				$resultUserGrafico = $user->listaUserGrafico(2);
			}

			foreach ($resultUserGrafico as $key => $value) {
				$resultUserGrafico[$key]['nome'] = utf8_encode($value['nome']);
			}





?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<span class="menu-text"> Relatório Resumo </span>
							</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">
						<form action="" method="GET">
							<div class="row">
								<div class="form-group">
									<div class="col-sm-3">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> De </label>
										<input id="dataDe" name="dataDe" type="date" style="width:100%" value="<?=$_GET['dataDe']?>" class="form-control" >
									</div>
									<div class="col-sm-3">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Até </label>
										<input id="dataAte" name="dataAte" type="date" style="width:100%;" value="<?=$_GET['dataAte']?>" class="form-control">
									</div>

<!-- 									<div class="col-sm-3" style="position:relative;">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Bairro </label>
										<input type="text"  placeholder="Bairro" class="col-xs-10 col-sm-12" name="bairro" id="bairro" />
										<div class="listaIstantSearch bairroSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>
									</div> -->
									<div class="col-sm-4">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Cidade </label>
										<input type="text"  placeholder="Cidade" class="col-xs-10 col-sm-12" id="cidade" value="<?=$_GET['cidade']?>" name="cidade" />
										<div class="listaIstantSearch cidadeSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>
									</div>

									<div class="col-sm-2">
										<label class="col-sm-12 control-label text-left no-margin" for="form-field-1" >UF</label>

										<select class="col-sm-12" name="uf" id="estadoFilter"/>
												 <option value="">Indiferente</option>
												 <option value="AC" <?=( $_GET['uf'] == 'AC'  ) ? 'selected':''?>>AC</option>
												 <option value="AL" <?=( $_GET['uf'] == 'AL'  ) ? 'selected':''?>>AL</option>
												 <option value="AP" <?=( $_GET['uf'] == 'AP'  ) ? 'selected':''?>>AP</option>
												 <option value="AM" <?=( $_GET['uf'] == 'AM'  ) ? 'selected':''?>>AM</option>
												 <option value="BA" <?=( $_GET['uf'] == 'BA'  ) ? 'selected':''?>>BA</option>
												 <option value="CE" <?=( $_GET['uf'] == 'CE'  ) ? 'selected':''?>>CE</option>
												 <option value="DF" <?=( $_GET['uf'] == 'DF'  ) ? 'selected':''?>>DF</option>
												 <option value="GO" <?=( $_GET['uf'] == 'GO'  ) ? 'selected':''?>>GO</option>
												 <option value="ES" <?=( $_GET['uf'] == 'ES'  ) ? 'selected':''?>>ES</option>
												 <option value="MA" <?=( $_GET['uf'] == 'MA'  ) ? 'selected':''?>>MA</option>
												 <option value="MT" <?=( $_GET['uf'] == 'MT'  ) ? 'selected':''?>>MT</option>
												 <option value="MS" <?=( $_GET['uf'] == 'MS'  ) ? 'selected':''?>>MS</option>
												 <option value="MG" <?=( $_GET['uf'] == 'MG'  ) ? 'selected':''?>>MG</option>
												 <option value="PA" <?=( $_GET['uf'] == 'PA'  ) ? 'selected':''?>>PA</option>
												 <option value="PB" <?=( $_GET['uf'] == 'PB'  ) ? 'selected':''?>>PB</option>
												 <option value="PR" <?=( $_GET['uf'] == 'PR'  ) ? 'selected':''?>>PR</option>
												 <option value="PE" <?=( $_GET['uf'] == 'PE'  ) ? 'selected':''?>>PE</option>
												 <option value="PI" <?=( $_GET['uf'] == 'PI'  ) ? 'selected':''?>>PI</option>
												 <option value="RJ" <?=( $_GET['uf'] == 'RJ'  ) ? 'selected':''?>>RJ</option>
												 <option value="RN" <?=( $_GET['uf'] == 'RN'  ) ? 'selected':''?>>RN</option>
												 <option value="RS" <?=( $_GET['uf'] == 'RS'  ) ? 'selected':''?>>RS</option>
												 <option value="RO" <?=( $_GET['uf'] == 'RO'  ) ? 'selected':''?>>RO</option>
												 <option value="RR" <?=( $_GET['uf'] == 'RR'  ) ? 'selected':''?>>RR</option>
												 <option value="SP" <?=( $_GET['uf'] == 'SP'  ) ? 'selected':''?>>SP</option>
												 <option value="SC" <?=( $_GET['uf'] == 'SC'  ) ? 'selected':''?>>SC</option>
												 <option value="SE" <?=( $_GET['uf'] == 'SE'  ) ? 'selected':''?>>SE</option>
												 <option value="TO" <?=( $_GET['uf'] == 'TO'  ) ? 'selected':''?>>TO</option>
										</select>	
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="form-group">								
									<?php 

										$tamanho = 8;

										if( $_SESSION['_sf2_attributes']['profileUser'] != 2 && $_SESSION['_sf2_attributes']['profileUser'] != 7 && $_SESSION['_sf2_attributes']['profileUser'] != 8 ):  
										$tamanho = 4;
											?>
										
											<div class="col-sm-4">
												<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Vendedor </label>
												<input type="text" idVendedor="" placeholder="Vendedor" value="<?=$_GET['vendedor']?>" class="col-xs-10 col-sm-12" name="vendedor" id="vendedor" autocomplete="off"/>
												<div class="listaIstantSearch vendedorSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
												</div>
											</div>
										
										<?php endif; ?>


									<div class="col-sm-4">
										<label class="col-sm-12 control-label no-padding-right no-margin" for="form-field-1"> Imobiliária </label>
										<input type="text" idImobiliaria="" placeholder="Imobiliária" value="<?=$_GET['imobiliaria']?>" class="col-xs-10 col-sm-12" name="imobiliaria" id="imobiliaria" autocomplete="off" />
										<div class="listaIstantSearch imobiliariaSearch hide col-xs-10 col-sm-9" style="top: 55px;width:80%;">
										</div>
									</div>
									<div class="col-sm-<?=$tamanho;?>">
										<label class="col-sm-12 control-label text-left no-margin" for="form-field-1" >Status</label>

										<select class="col-sm-12" id="statusFilter" name="statusFilter"/>
											<option value="0">Indiferente</option>
											<?php 

												$status = new Status();
												$resultStatus = $status->listaStatus(); 

												foreach ($resultStatus as $key => $value) {

												?>
													<option value="<?=$value['sta_id']?>" <?=( $_GET['statusFilter'] == $value['sta_id']  ) ? 'selected':''?>  ><?=$value['sta_referencia']?> - <?=utf8_encode($value['sta_nome'])?></option>
											<?php } ?>
										</select>
									</div>

								</div>
							</div>
							<br>
							<div class="row text-center">
								<div class="col-sm-12">
									<input type="hidden" name="idVendedor" id="idVendedor" value="<?=$_GET['idVendedor']?>">
									<input type="hidden" name="idImobiliaria" id="idImobiliaria" value="<?=$_GET['idImobiliaria']?>">
									<input type="submit" class="btn btn-primary" value="Buscar">
									<a href="relatorioExtra.php" class="btn btn-primary">Limpar Filtro</a>
								</div>
							</div>
						</form>




						<div class="hr hr-16 hr-dotted"></div>
						<div class="row">
							<div class="col-sm-6 text-center">
								 <div id="chart_div" style="width:100%; height:300px;"></div>
							</div>
							<div class="col-sm-6 text-center">
								 <div id="chart_divDays" style="width:100%; height:300px;"></div>
							</div>
						</div><!-- /.col -->
						
						<br>
						<p>*fitros de Data não se aplicam ao grafico e resumo</p>
						<br>

						<h4 style="display:block; text-align:center">Clientes por Vendedor / Estado <i class="fa fa-sort-amount-asc"></i></h4>	
 						<div class="row">
							<div class="col-sm-12">
								<table class="table table-striped table-bordered">
									<thead>
										<tr  style="font-size:11px!important;">
											<th class="center">Nome Vendedor</th>

											<?php 

												$ufDistinct = $relatorio->resumoGeralDistinctUf();
													
												if ( $_SESSION['_sf2_attributes']['profileUser'] == 2 || $_SESSION['_sf2_attributes']['profileUser'] >= 7){
													$resultGeral = $relatorio->resumoGeralVendedoresV2($_SESSION['_sf2_attributes']['idUser']);
												}else{
													if(isset($_GET['idVendedor'])){
														$resultGeral = $relatorio->resumoGeralVendedoresV2($_GET['idVendedor']);
													}else{
														$resultGeral = $relatorio->resumoGeralVendedoresV2();
													}
												}

												$newListagem;

												foreach ($resultGeral as $key => $value){

													if(!isset($newListagem[$value['id']])){
														$newListagem[$value['id']]['nm'] = $value["nome"];

														foreach ($ufDistinct as $keyuf => $valueuf) {
															$newListagem[$value['id']]['uf'][$valueuf['cli_uf']] = 0;
														}
													}

													$newListagem[$value['id']]['uf'][$value['cli_uf']] += $value['total'];
												}

												$qtdColSpan = 1;											

												foreach ($ufDistinct as $keyuf => $valueuf) {
													echo '<th class="center">'.$valueuf['cli_uf'].'</th>';
													$qtdColSpan++;
												}
											?>

											<th class="center">Total</th>
										</tr>
									</thead>
									<tbody class="geralVendedores hide">
											<?php 

												// echo "<pre>";
												// print_r($newListagem);
												// echo "</pre>";
												
												$totalVendedorGeral = 0;
												$somaPorEstado;

												foreach ($newListagem as $chave => $valor){
													
													$totalVendedor = 0;

												 	echo '<tr>';
													echo '<td class="center">'.utf8_encode($valor['nm'])." - ".$chave.'</td>';
												    
													foreach ($valor['uf'] as $key => $value) {
														echo '<td class="center">'.$value.'</td>';
														$totalVendedor += $value;
														$somaPorEstado[$key] += $value;
													}

													echo '<td class="center">'.$totalVendedor.'</td>';		
													$totalVendedorGeral += $totalVendedor;
													echo '</tr>';
												}
												
												echo '<tr>';
												echo '<td class="center"><b>Total Geral</b></td>';
												foreach ($ufDistinct as $keyuf => $valueuf) {
													// print_r($somaPorEstado);
													echo '<td class="center"><b>'.$somaPorEstado[$valueuf['cli_uf']].'</b></td>';
												}
												echo '<td class="center"><b>'.$totalVendedorGeral.'</b></td>';
												echo '</tr>';
											?>
									</tbody>
								</table>
							</div>
						</div> 


	
						<div class="row">
							<h4 style="display:block; text-align:center">Clientes por Status</h4>
							<div class="col-sm-12">
								<table class="table table-striped table-bordered">
									<thead>
										<tr  style="font-size:11px!important;">
											<th class="center" style="color:#3f76e9;"><b>TT Clientes</b></th>

											<?php
												
												$result = $status->listaStatus();

												foreach ($result as $key => $value){
													$headerTabela[$value['sta_status']]['total'] = 0;
													$headerTabela[$value['sta_status']][$value['sta_referencia']] = $value['sta_referencia'];
												}
											
												foreach ($headerTabela as $key => $value){

													switch ($key) {
														case 10:
															$texto = 'EFET';
															break;
														case 20:
															$texto = 'PROSP';
															break;
														case 30:
															$texto = 'NEGAT';
															break;
														case 40:
															$texto = 'CANCE';
															break;
														case 50:
															$texto = 'RETEN';
															break;
														default:
															$texto = 'INDEF';
															break;
													} ?>

													<th class="center" style="color:#fc6f11;"><b>TT <?=$texto;?></b></th>													
												
													<?php 

													foreach ($value as $indice => $ref) { 

														if($indice != 'total'){
														?>

														<th class="center"><?=$ref;?></th>
													
													<?php }
													}
												}
											?>

										</tr>
									</thead>

									<tbody>
										<tr>
										
										<?php 
											

											$resultRel = $relatorio->quantidadeCLientesPorStatus();


											foreach ($resultRel as $key => $value) {
												
												$headerTabela[$value['sta_status']]['total'] +=  $value['total'];
												$headerTabela[$value['sta_status']][$value['sta_referencia']] = $value['total'];
											}

											foreach ($headerTabela as $key => $value) {
												foreach ($value as $ind => $val) {
													if($ind == $val){
														$headerTabela[$key][$ind] = 0;
													}
												}
											} ?>

											<td class="center" style="color:#3f76e9;">
												<?php 
													// echo $resultGeral = $relatorio->quantidadeCLientesPorStatus(); 

													$totalGeral = 0;													

													foreach ($resultRel as $key => $value) {
														$totalGeral += $value['total'];
													}
													
													echo '<b>'.$totalGeral.'</b>'; 

													// $historicoNoStats = $relatorio->historicoSemStatus();
													// echo $totalGeral += $historicoNoStats[0]['total']; 
												?>
											</td>

											<?php 
											foreach ($headerTabela as $key => $value) { 
													$totalStatus = $headerTabela[$key]['total'];

													$porcentagemStatus =  $totalStatus / $totalGeral * 100;
													$porcentagemStatus = round($porcentagemStatus, 2) ."%";

											?>
												<td class="center" style="color:#fc6f11;"><?=$totalStatus;?><br><b><?=$porcentagemStatus;?></b></td>

												<?php 
													foreach ($value as $indice => $ref) { 
														if($indice != 'total'){	

															$porcentagem  =  $ref / $totalGeral  * 100;
															$porcentagem = round($porcentagem, 2) ."%";

															?>
															<td class="center"><?=$ref;?><br><b><?=$porcentagem?></b>
															</td>
										<?php 			}
													}
											}

										 ?>
										</tr>
									</tbody>
								</table>
							</div>

							<h4 style="display:block; text-align:center">Resumo Historicos de Clientes</h4>
							<div class="col-sm-12">
								<table class="table table-striped table-bordered resumoHistoricoCli">
									<thead>
										<tr>
											<th>Data Inclusão</th>
											<th>Nome Vendedor</th>
											<th>Nome Imobiliária</th>
											<th>Status</th>
											<th>Imóveis Locação</th>
											<th>Cidade</th>
											<th>UF</th>
											<th>Contato</th>
											<th>Nº Contat.</th>
											<th>Data Ultimo Histor.</th>
											<th>Ultimo Histórico</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$resultListagem = $relatorio->ListagemClientes();

										foreach ($resultListagem as $key => $value){ ?>
											<tr>

												<td class="center" style="position: relative;">
													<a href="cadastroClientes.php?idCliente=<?=$value['cli_id']?>"><i class="fa fa-file-text"> Ver Dados</i></a>
													<?=date('d/m/Y', strtotime($value['cli_data_cadastro']))?><br>


												<?php if ( $_SESSION['_sf2_attributes']['profileUser'] == 1 || $_SESSION['_sf2_attributes']['profileUser'] == 4){ ?>
													<i class="fa fa-plus-circle transfereCliente"></i>
													<div class="listagemClientes hide"></div>
												<?php } ?>

												</td>
												<td class="center"><?=($value['nome'] == '')? 'Não Atribuido' : utf8_encode($value['nome']);   ?></td>
												
												<td class="center linhaCliente" style="position:relative;" idCliente="<?=$value['cli_id']?>" > <b style="color:orange;"><?=utf8_encode($value['cli_nome']);?></b>
													<div class="listagemFeedback hide" style="display:block; z-index:9999; width:400px; height:400px; overflow-y:scroll; position:absolute; top: 0; background: #fff; left:200px;  border: 1px solid #aaa; box-shadow: 0px 0px 10px 4px #ccc;"></div>
												</td>
												
												<td class="center"><?=utf8_encode($value['sta_referencia']);?></td>
												<td class="center"><?=$value['cli_quantidade_imoveis']?></td>
												<td class="center"><?=utf8_encode($value['cli_cidade'])?></td>
												<td class="center"><?=$value['cli_uf']?></td>
												<td class="center"><?=$value['cli_nome_contato']?></td>
												<?php $qtdHistoricos =  $relatorio->countHistoricoCLiente($value['cli_id'])?>
												<td class="center"><?=$qtdHistoricos[0]['qtdHistorico'];?></td>
												<td class="center"><?=( date('d/m/Y', strtotime($value['his_data_cadastro'])) == '31/12/1969' )? "--": date('d/m/Y', strtotime($value['his_data_cadastro'])); ?></td>
												<td class="center"><?=$value['his_conteudo']?>
																	<?=' - (<b>'.$value['his_decisor'].'</b>)';?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>								
							</div>
						</div>
						
						<?php $resultPag = $relatorio->paginacaoListagemClientes();	 ?>

<?php 
	
	parse_str($_SERVER["QUERY_STRING"], $slug);

	function convertSlug($arraySlug){

		$return = '';

		foreach ($arraySlug as $key => $value){

			$return .= $key.'='.$value.'&';

		}

		return substr($return, 0, -1);
	}

?>

						<div class="row text-center">
							<ul class="pagination">
								<li <?=( !isset($_GET['p']) || $_GET['p'] == 1 )? "class='disabled'" : ""; ?> >
									<?php $slug['p'] = 1; $slugModif = convertSlug($slug); ?>
									<a href="?<?=$slugModif;?>">
										<i class="ace-icon fa fa-angle-double-left"></i>
									</a>
								</li>
								 
								<?php  
									$pg = 1;
									if( isset($_GET['p']) && $_GET['p'] != ''){
										$pg	= $_GET['p'];
									} 
								?>

								<?php 

								if( $resultPag['numPaginas'] >= 10 || $pg > 5): 
									for($i = $pg-4; $i < $pg; $i++): 
										if( $i >= 1 ):?>
										<li <?=($pg == $i ) ? "class='active'": "" ?> >
											<?php $slug['p'] = $i; $slugModif = convertSlug($slug); ?>
											<a href="?<?=$slugModif;?>"><?=$i?></a>
										</li><?php 
										endif;
									endfor;
									for($i = $pg; $i < $pg+6; $i++):
										if( $i <= $resultPag['numPaginas'] ): ?>
											<li <?=($pg == $i ) ? "class='active'": "" ?> >
												<?php $slug['p'] = $i; $slugModif = convertSlug($slug); ?>
												<a href="?<?=$slugModif;?>"><?=$i?></a>
											</li><?php
										endif;
									endfor;
								else: 
									for($i = 1; $i < $resultPag['numPaginas'] + 1; $i++): ?>
										<li <?=($pg == $i ) ? "class='active'": "" ?> >
											<?php $slug['p'] = $i; $slugModif = convertSlug($slug); ?>
											<a href="?<?=$slugModif;?>"><?=$i?></a>
										</li><?php 
									endfor; ?><?php 
								endif; ?>

								<li <?=( isset($_GET['p']) && $_GET['p'] == $resultPag['numPaginas'] )? "class='disabled'" : ""; ?> >
									<?php $slug['p'] = $resultPag['numPaginas']; $slugModif = convertSlug($slug); ?>
									<a href="?<?=$slugModif;?>">
										<i class="ace-icon fa fa-angle-double-right"></i>
									</a>
								</li>
								<li style="display:block;margin-top:40px;">Total de <b><?=$resultPag['numPaginas']?></b> Paginas</li>
							</ul>
						</div>

						<div class="row text-center">
							<a href="exportaExcel.php?<?=$slugModif;?>" style="display:block; padding: 5px 12px; background:darkgreen;color:#fff; text-decoration:none; width:200px; margin: 0 auto;">Exportar para o Excel</a>
						</div>

						

					</div><!-- /.row

					</div><!-- /.page-content -->

				</div>
			</div><!-- /.main-content -->
			<!-- PAGE CONTENT ENDS -->	
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/fuelux.spinner.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/jquery.knob.min.js"></script>
		<script src="assets/js/jquery.autosize.min.js"></script>
		<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/relatorioScript.js"></script>


		<script>
            // $( ".datepicker" ).datepicker({
            //     dateFormat: "mm-dd-yy"
            // });
			$(".datepicker").datepicker("option", "dateFormat", "yy-mm-dd ");
		</script>
		<script type="text/javascript">
			
			var chart;
			var data;
			var chart2;
			
			var date = new Date();
			var mes = date.getMonth() + 1;
			var ano = date.getFullYear();
			var meses = new Array;
			var anos = new Array;

			meses[12] = mes;
			anos[12] = ano;

			for(var i = 11; i > 0; i--){
				mes--;
				if(mes == 0){
					mes = 12;
					ano = ano - 1;
				}

				meses[i] = mes;
				anos[i] = ano;
			}

	    	function selectionHandler() {

	    		var selectedData = chart.getSelection(), row, item;
				row = selectedData[0].row;

				var string = '<?php echo json_encode($resultUserGrafico); ?>';
				var filters = '<?php echo json_encode($parameterRelAjax); ?>';

			    $.ajax({
			        url: "ajax/ChartAjax.php", //URL de destino
			        data : {'resultUser': string, 'filters': filters, 'mes': meses[row+1], 'ano': anos[row+1]}, // OQ TA SENDO PASSADO POR GET
			        method : 'POST',
			        dataType: "json",
			        beforeSend: function(){
			        	$("#chart_divDays").html('<img style="width:65px; margin-top:120px;" src="assets/img/loading2.gif">');
			        },
			        success: function(data)
			        {
						var obj = $.parseJSON(data);
				  	    var data2 = google.visualization.arrayToDataTable(obj);
					    var options2 = {
					      vAxis: {title: 'Quantidade', slantedText:true, slantedTextAngle:90},
					      hAxis: {title: 'Dias', slantedText:true, slantedTextAngle:90},
					      seriesType: 'bars',
					      legend:'bottom',
							<?php if ( empty($_GET['idVendedor']) ): ?>
								isStacked: true,
							<?php endif; ?>
					      bar: { groupWidth: '50%' },
					      height: 350	
					    };

					    chart2 = new google.visualization.ComboChart(document.getElementById('chart_divDays'));
					    chart2.draw(data2, options2);
			        }
			    });
		    }

// =================== Ja funciona =============
		    function drawVisualization(){

				var string = '<?php echo json_encode($resultUserGrafico); ?>';
				var filters = '<?php echo json_encode($parameterRelAjax); ?>';

			    $.ajax({
			        url: "ajax/ChartAjaxAno.php", //URL de destino
			        data : {'resultUser': string, 'filters': filters, 'indicador': 'last12Months' }, // OQ TA SENDO PASSADO POR GET
			        method : 'POST',
			        dataType: "json",
			        beforeSend: function(){
			        	$("#chart_div").html('<img style="width:65px; margin-top:120px;" src="assets/img/loading2.gif">');
			        },
			        success: function(data)
			        {
			        	// console.log(data);
						var obj = $.parseJSON(data);
						var data = google.visualization.arrayToDataTable(obj);
					    var options = {
						title : 'Lista de Contatos por mês',
						vAxis: {title: 'Quantidade', slantedText:true, slantedTextAngle:90},
						hAxis: {title: 'Mẽs', slantedText:true, slantedTextAngle:90},
						seriesType: 'bars',
						legend:'bottom',
							<?php if ( empty($_GET['idVendedor']) ): ?>
								isStacked: true,
							<?php endif; ?>
						bar: { groupWidth: '50%' },
						height: 350
					    };

					    chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
					    chart.draw(data, options);
						
						google.visualization.events.addListener(chart, 'select', selectionHandler);
			        }
			    });

		  	}

			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawVisualization);


		    function drawVisualizationDays() {
				var string = '<?php echo json_encode($resultUserGrafico); ?>';
				var filters = '<?php echo json_encode($parameterRelAjax); ?>';

				// var cidade = '<?php if( isset($parameterRelAjax['cidade'])){ echo $parameterRelAjax['cidade']; } ?>';

			    $.ajax({
			        url: "ajax/ChartAjax.php", //URL de destino
			        data : {'resultUser': string, 'filters': filters, 'indicador': 'detailCurrentMonth' }, // OQ TA SENDO PASSADO POR GET
			        method : 'POST',
			        dataType: "json",
			        beforeSend: function(){
			        	$("#chart_divDays").html('<img style="width:65px; margin-top:120px;" src="assets/img/loading2.gif">');
			        },
			        success: function(data)
			        {
			        	// console.log(data);

						var obj = $.parseJSON(data);
				  	    var data2 = google.visualization.arrayToDataTable(obj);
					    var options2 = {
					    	title : 'Lista de Contatos por dia',
							vAxis: {title: 'Quantidade', slantedText:true, slantedTextAngle:90},
							hAxis: {title: 'Dias', slantedText:true, slantedTextAngle:90 },
							seriesType: 'bars',
							legend:'bottom',
							<?php if ( empty($_GET['idVendedor']) ): ?>
								isStacked: true,
							<?php endif; ?>
							bars: 'vertical',
							bar: { groupWidth: '50%' },
							height: 350				
					    };

// var options ={ hAxis: {title: "Years" , direction:-1, slantedText:true, slantedTextAngle:90 }}

					    chart2 = new google.visualization.ComboChart(document.getElementById('chart_divDays'));
					    chart2.draw(data2, options2);
			        }
			    });
		  	}
		    
		    google.load("visualization", "1", {packages:["corechart"]});
		    google.setOnLoadCallback(drawVisualizationDays);

		</script>

		<?php  include('modalAviso.php'); ?>
	</body>
</html>
