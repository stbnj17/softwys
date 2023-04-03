<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoGasto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Gatos</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_gasto" name="guardar_gasto">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="referencia" class="control-label">Referencia:</label>
									<input type="text" class="form-control" id="referencia" name="referencia"  autocomplete="off">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="fech" class="control-label">Fecha:</label>
									<input type="date" class="form-control" id="fech" name="fech"  autocomplete="off">
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="monto" class="control-label">Monto:</label>
									<input type="text" class="form-control" id="monto" name="monto" autocomplete="off" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo" class="control-label">Tipo de Gasto:</label>
									<select class="form-control" id="tipo" name="tipo" required>
										<option value="">-- Selecciona --</option>
										<?php

    $query_tipo = mysqli_query($conexion, "select * from tipo_gasto order by nombre_tipo");
    while ($rw = mysqli_fetch_array($query_tipo)) {
        ?>
											<option value="<?php echo $rw['id_tipo']; ?>"><?php echo $rw['nombre_tipo']; ?></option>
											<?php
}
    ?>

									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="descripcion" class="control-label">Descripción</label>
									<textarea class="form-control UpperCase"  id="descripcion" name="descripcion" maxlength="255"  autocomplete="off"></textarea>
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