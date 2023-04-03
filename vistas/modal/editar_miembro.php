<?php
if (isset($conexion)) {
    ?>
	<div id="editarPaciente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Editar Miembro</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_miembro" name="editar_miembro">
						<div id="resultados_ajax2"></div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="mod_nombre" class="control-label">Nombre:</label>
									<input type="text" class="form-control UpperCase" id="mod_nombre" name="mod_nombre" autocomplete="off" required>
									<input type="hidden" name="mod_id" id="mod_id">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="mod_apellido" class="control-label">Apellido:</label>
									<input type="text" class="form-control UpperCase" id="mod_apellido" name="mod_apellido" autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="mod_direccion" class="control-label">Dirección:</label>
									<textarea class="form-control UpperCase"  id="mod_direccion" name="mod_direccion" maxlength="255" autocomplete="off"></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="mod_ciudad" class="control-label">Ciudad:</label>
									<textarea class="form-control UpperCase"  id="mod_ciudad" name="mod_ciudad" maxlength="255" autocomplete="off"></textarea>
								</div>
							</div>
						</div>

	<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="tipo" class="control-label">Familia:</label>
									<select class="form-control" id="mod_family" name="mod_family" onchange="showDiv(this)">
										<option value="">-- Selecciona --</option>
										<?php

    $query_family = mysqli_query($conexion, "select * from familias order by nombre");
    while ($rw = mysqli_fetch_array($query_family)) {
        ?>
													<option value="<?php echo $rw['id_familia']; ?>"><?php echo $rw['nombre']; ?></option>
													<?php
}
    ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="celular" class="control-label">Tel. Celular</label>
									<input type="text" class="form-control" id="mod_celular" name="mod_celular" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="telefono" class="control-label">Tel. Fijo</label>
									<input type="text" class="form-control" id="mod_telefono" name="mod_telefono" autocomplete="off" required>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="documento" class="control-label">No.Cedula</label>
									<input type="text" class="form-control" id="mod_documento" name="mod_documento" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="nacimiento" class="control-label">Fecha de Nacimento</label>
									<input type="date" class="form-control" id="mod_nacimiento" name="mod_nacimiento" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="estudio" class="control-label">Nivel de Estudio</label>
									<select class="form-control" id="mod_estudio" name="mod_estudio" required>
										<option value="">-- Selecciona --</option>
										<option value="1">Primaria</option>
										<option value="2">Secundaria</option>
										<option value="3">Bachillerato</option>
										<option value="4">Licenciatura</option>
										<option value="5">Maestria</option>
										<option value="6">Doctorado</option>
										<option value="7">Superior</option>
									</select>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="cargo" class="control-label">Cargo</label>
									<select class="form-control" id="mod_cargo" name="mod_cargo" required>
										<option value="">-- Selecciona --</option>
										<option value="1">Pastor</option>
										<option value="2">Diacono</option>
										<option value="3">Sec-General</option>
										<option value="4">Tes-Genral</option>
										<option value="5">Jovenes</option>
										<option value="6">Damas</option>
										<option value="7">Varones</option>
										<option value="8">Infantil</option>
										<option value="9">Esc.Dominical</option>
										<option value="10">Evangelismo</option>
										<option value="11">Exploradores</option>
										<option value="12">Misiones</option>
										<option value="13">Obrero</option>
										<option value="14">Musico</option>
										<option value="15">Maestro</option>
										<option value="16">Otros</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="civil" class="control-label">Estado Civil</label>
									<select class="form-control" id="mod_civil" name="mod_civil" required>
										<option value="">-- Selecciona --</option>
										<option value="1">Soltero</option>
										<option value="2">Casado</option>
										<option value="3">Divorciado</option>
										<option value="4">Separación en proceso judicial</option>
										<option value="5">Viudo</option>
										<option value="6">Concubinato</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="sexo" class="control-label">Sexo:</label>
									<select class="form-control" id="mod_sexo" name="mod_sexo" required>
										<option value="">-- Selecciona --</option>
										<option value="1">Masculino</option>
										<option value="0">Femenino</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="encargado" class="control-label">Email:</label>
									<input type="email" class="form-control" id="mod_email" name="mod_email" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="estado" class="control-label">Estado:</label>
									<select class="form-control" id="mod_estado" name="mod_estado" required>
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