<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoAst" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nueva Asistencia</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_ast" name="guardar_ast">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="id_cel" class="control-label">Célula:</label>
									<select class="form-control" id="id_cel" name="id_cel" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c;" required>
										<option value="">-- Seleccionar Celula --</option>
													<?php

    $query_tipoi = mysqli_query($conexion, "select id_celula, nombre_cel from celulas order by nombre_cel");
    while ($rw = mysqli_fetch_array($query_tipoi)) {
        ?>
													<option value="<?php echo $rw['id_celula']; ?>"><?php echo $rw['nombre_cel']; ?></option>
													<?php
}
    ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="herm" class="control-label">Hermanos:</label>
									<input type="number" class="form-control UpperCase" id="herm" name="herm"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="amigos" class="control-label">Amigos:</label>
									<input type="number" class="form-control UpperCase" id="amigos" name="amigos"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ninos" class="control-label">Niños:</label>
									<input type="number" class="form-control UpperCase" id="ninos" name="ninos"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ofrenda" class="control-label">Ofrenda:</label>
									<input type="text" class="form-control number-only" id="ofrenda" name="ofrenda"  autocomplete="off" style=" background-color:#FDEDEC; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="conv" class="control-label">Conv:</label>
									<input type="number" class="form-control UpperCase" id="conv" name="conv"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="recon" class="control-label">Recon:</label>
									<input type="number" class="form-control UpperCase" id="recon" name="recon"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="baut" class="control-label">Bautismos:</label>
									<input type="number" class="form-control UpperCase" id="baut" name="baut"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="sem" class="control-label">Seminarista:</label>
									<input type="number" class="form-control UpperCase" id="sem" name="sem"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ast" class="control-label">Ast. Iglesia:</label>
									<input type="number" class="form-control UpperCase" id="ast" name="ast"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="fecha" class="control-label">Fecha:</label>
									<input type="date" class="form-control UpperCase" id="fecha" name="fecha"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
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