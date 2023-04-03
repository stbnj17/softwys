<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoIngreso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Diezmo</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_ingreso" name="guardar_ingreso">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nombre_miembro" class="control-label">Miembro (Elegir y Enter)</label>
									<input type="text" class="form-control" placeholder="Buscar Miembor por Nombre" id="nombre_miembro" par autocomplete="off" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c" required>
									<input id="id_miembro" name="id_miembro" type='hidden'>

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div id="resultados3"></div><!-- Carga los datos ajax del incremento de la fatura -->
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo" class="control-label">Categoria:</label>
									<select class="form-control" id="tipo" name="tipo" onchange="showDiv(this)" required>
										<option value="">Selecciona</option>
										<?php

    $query_tipoi = mysqli_query($conexion, "select * from tipo_ingreso order by nombre_tipoi");
    while ($rw = mysqli_fetch_array($query_tipoi)) {
        ?>
													<option value="<?php echo $rw['id_tipoi']; ?>"><?php echo $rw['nombre_tipoi']; ?></option>
													<?php
}
    ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="monto" class="control-label">Modo de Pago</label>
									<select class="form-control" id="modo" name="modo" required>
										<option value="">-- Selecciona --</option>
										<option value="1">EFECTIVO</option>
										<option value="2">CHEQUE</option>
										<option value="3">TRANSFERENCIA BANCARIA</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="monto" class="control-label">Monto</label>
									<input type="text" class="form-control" id="monto" name="monto" autocomplete="off" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="fech" class="control-label">Fecha:</label>
									<input type="date" class="form-control" id="fech" name="fech"  autocomplete="off">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="obs" class="control-label">Observación</label>
									<textarea class="form-control UpperCase"  id="obs" name="obs" maxlength="255"  autocomplete="off"></textarea>
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