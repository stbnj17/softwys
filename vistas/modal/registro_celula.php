<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoCelula" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nueva Células</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_celula" name="guardar_celula">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre" class="control-label">Nombre:</label>
									<input type="text" class="form-control UpperCase" id="nombre" name="nombre"  autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="sector" class="control-label">Sector:</label>
									<input type="text" class="form-control UpperCase" id="sector" name="sector"  autocomplete="off">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="supervisor" class="control-label">Spervisor (Elegir y Enter)</label>
									<input type="text" class="form-control" placeholder="Buscar Miembro por Nombre" id="nombre_miembro1" par autocomplete="off" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c">
									<input id="id_miembro1" name="id_miembro1" type='hidden'>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lider" class="control-label">Lider (Elegir y Enter)</label>
									<input type="text" class="form-control" placeholder="Buscar Miembro por Nombre" id="nombre_miembro2" par autocomplete="off" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c">
									<input id="id_miembro2" name="id_miembro2" type='hidden'>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="anfi">Anfitrion</label>
									<input id="anfi" class="form-control UpperCase" type="text" name="anfi">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="grupo" class="control-label">Grupo:</label>
									<select class="form-control" id="grupo" name="grupo" required>
										<option value="1" selected>Niños</option>
										<option value="2">Jovenes</option>
										<option value="3">Adultos</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="estado" class="control-label">Estado:</label>
									<select class="form-control" id="estado" name="estado" required>
										<option value="">-- Selecciona --</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									</select>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-rounded waves-effect" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light" id="guardar_datos">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>