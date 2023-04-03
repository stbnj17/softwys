<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoBienes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Bienes y Muebles</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_bienes" name="guardar_bienes">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Nombre:</label>
									<input type="text" class="form-control UpperCase" id="nombre" name="nombre"  autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="descripcion" class="control-label">Descripción:</label>
									<textarea class="form-control UpperCase"  id="descripcion" name="descripcion" maxlength="255" autocomplete="off"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="serie" class="control-label">No. Serie:</label>
									<input type="text" class="form-control UpperCase" id="serie" name="serie"  autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="modelo" class="control-label">Modelo:</label>
									<input type="text" class="form-control UpperCase" id="modelo" name="modelo"  autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="color" class="control-label">Color:</label>
									<input type="text" class="form-control UpperCase" id="color" name="color"  autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="est" class="control-label">Estado:</label>
									<select class="form-control" id="estado" name="estado" required>
										<option value="">-- Selecciona --</option>
										<option value="1">Nuevo</option>
										<option value="2">En Uso</option>
										<option value="3">Dañado</option>
										<option value="4">Reparacion</option>
										<option value="5">Inservible</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="estado" class="control-label">Status:</label>
									<select class="form-control" id="status" name="status" required>
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