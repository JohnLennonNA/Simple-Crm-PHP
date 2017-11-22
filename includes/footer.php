<script src="assets/js/aviso.js"></script>

		<a href="#modalAviso" role="button" class="bigger-125 bg-primary white ativaAviso" data-toggle="modal"></a>

		<div id="modalAviso" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close closeModalAviso" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin" id="">Lembrete de Contato</h3>
					</div>

					<div class="modal-body">

						<div class="col-sn-12">
							<p>Ligar para o cliente</p>
							<i class="ace-icon fa fa-building-o"> <b id="tituloClienteAviso"></b> </i>
						</div>
						<br>
						<div class="col-sn-12">
							<p>Horario Agendado</p>
							<i class="ace-icon fa fa-clock-o"> <b id="dataAgendamento"></b> </i>
						</div>
					
					</div>

					<div class="modal-footer">
						<a href="" class="btn btn-sm btn-success pull-right" id="linkAtendimento">
							<i class="ace-icon fa fa-phone"></i>
							Ligar Agora
						</a>
						<button class="btn btn-sm btn-danger pull-right" id="ligarDepois">
							<i class="ace-icon fa fa-clock-o"></i>
							Me lembre em 1 hora
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>