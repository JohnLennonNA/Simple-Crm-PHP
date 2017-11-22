<?php
include("../class/class.relatorios.php");

$relatorio = new Relatorio();

$result = $relatorio->qtdImoveisImobiliarias();

foreach ($result as $key => $value){ ?>
	<tr>
		<td><?=$value['nome']?></td>
		<td><?=$value['qtdImobiliarias']?></td>
		<td><?=$value['qtdImoveis']?></td>
	</tr>
<?php } ?>
