<?php
if (isset($conexion)) {
    ?>
	<div id="editarIngreso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Edita Ofrenda</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_ingreso" name="editar_ingreso">
						<div id="resultados_ajax2"></div>
						<input type="hidden" name="mod_id" id="mod_id">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="mod_miembro">
										Miembro:
									</label>
									<input autocomplete="off" class="form-control" disabled="true" id="mod_nombre" par="" placeholder="Buscar Miembro por Nombre" required="" type="text">
									<input id="mod_id_miembro" name="mod_id_miembro" type="hidden">
								</input>
							</input>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
								<div class="form-group">
									<label for="mod_tipo" class="control-label">Referencia:</label>
									<input type="text" class="form-control" id="mod_ref" name="mod_ref" autocomplete="off" readonly>
								</div>
							</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="mod_tipo" class="control-label">Categoria:</label>
							<select class="form-control" id="mod_tipo" name="mod_tipo" onchange="showDiv2(this)" required>
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
							<label for="mod_monto" class="control-label">Modo de Pago</label>
							<select class="form-control" id="mod_modo" name="mod_modo" required>
								<option value="">-- Selecciona --</option>
								<option value="1">EFECTIVO</option>
								<option value="2">CHEQUE</option>
								<option value="3">TRANSFERENCIA BANCARIA</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="mod_monto" class="control-label">Monto</label>
							<input type="text" class="form-control" id="mod_monto" name="mod_monto" autocomplete="off" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" style=" background-color:#A9D0F5; border-radius: 5px; border: 1px solid #39c" required>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="mod_fech" class="control-label">Fecha:</label>
							<input type="date" class="form-control" id="mod_fech" name="mod_fech"  autocomplete="off">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="mod_obs" class="control-label">Observación</label>
							<textarea class="form-control UpperCase"  id="mod_obs" name="mod_obs" maxlength="255"  autocomplete="off"></textarea>
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