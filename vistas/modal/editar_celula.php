<?php
if (isset($conexion)) {
    ?>
	<div id="editarCelula" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Editar Células</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_celula" name="editar_celula">
						<div id="resultados_ajax2"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre2" class="control-label">Nombre:</label>
									<input type="text" class="form-control UpperCase" id="nombre2" name="nombre2"  autocomplete="off" required>
									<input id="mod_id" name="mod_id" type='hidden'>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="sector2" class="control-label">Sector:</label>
									<input type="text" class="form-control UpperCase" id="sector2" name="sector2"  autocomplete="off" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="supervisor2" class="control-label">Spervisor (Elegir y Enter)</label>
									<input type="text" class="form-control" placeholder="Buscar Miembor por Nombre" id="nombre_miembro3" par autocomplete="off" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c" required>
									<input id="id_miembro3" name="id_miembro3" type='hidden'>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lider2" class="control-label">Lider (Elegir y Enter)</label>
									<input type="text" class="form-control" placeholder="Buscar Miembor por Nombre" id="nombre_miembro4" par autocomplete="off" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c" required>
									<input id="id_miembro4" name="id_miembro4" type='hidden'>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="form-group">
									<label for="anfi">Anfitrion</label>
									<input id="anfi2" class="form-control UpperCase" type="text" name="anfi2">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="grupo2" class="control-label">Grupo:</label>
									<select class="form-control" id="grupo2" name="grupo2" required>
										<option value="1" selected>Niños</option>
										<option value="2">Jovenes</option>
										<option value="3">Adultos</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="estado2" class="control-label">Estado:</label>
									<select class="form-control" id="estado" name="estado2" required>
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
						<button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light" id="actualizar_datos">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>