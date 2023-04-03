<?php
if (isset($conexion)) {
    ?>
	<div id="editarGasto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Editar Gasto</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_gasto" name="editar_gasto">
						<div id="resultados_ajax2"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="mod_referencia" class="control-label">Referencia:</label>
									<input type="text" class="form-control" id="mod_referencia" name="mod_referencia"  autocomplete="off">
									<input id="mod_id" name="mod_id" type='hidden'>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="mod_fech" class="control-label">Fecha:</label>
									<input type="date" class="form-control" id="mod_fech" name="mod_fech"  autocomplete="off">
								</div>
							</div>
							</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="mod_monto" class="control-label">Monto</label>
									<input type="text" class="form-control" id="mod_monto" name="mod_monto" autocomplete="off">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="mod_tipo" class="control-label">Tipo de Gasto:</label>
									<select class="form-control" id="mod_tipo" name="mod_tipo" required>
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
									<label for="mod_descripcion" class="control-label">Descripción</label>
									<textarea class="form-control UpperCase"  id="mod_descripcion" name="mod_descripcion" maxlength="255"  autocomplete="off"></textarea>
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