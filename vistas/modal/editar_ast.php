<?php
if (isset($conexion)) {
    ?>
	<div id="editarAst" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Editar Asistencia</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_ast" name="editar_ast">
						<div id="resultados_ajax2"></div>

						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="id_cel2" class="control-label">Célula:</label>
									<select class="form-control" id="id_cel2" name="id_cel2" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c;" required>
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
									<label for="herm2" class="control-label">Hermanos:</label>
									<input type="number" class="form-control UpperCase" id="herm2" name="herm2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
									<input id="mod_id" name="mod_id" type='hidden'>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="amigos2" class="control-label">Amigos:</label>
									<input type="number" class="form-control UpperCase" id="amigos2" name="amigos2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ninos2" class="control-label">Niños:</label>
									<input type="number" class="form-control UpperCase" id="ninos2" name="ninos2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ofrenda2" class="control-label">Ofrenda:</label>
									<input type="text" class="form-control number-only" id="ofrenda2" name="ofrenda2"  autocomplete="off" style=" background-color:#FDEDEC; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="conv2" class="control-label">Conv:</label>
									<input type="number" class="form-control UpperCase" id="conv2" name="conv2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="recon2" class="control-label">Recon:</label>
									<input type="number" class="form-control UpperCase" id="recon2" name="recon2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="baut2" class="control-label">Bautismos:</label>
									<input type="number" class="form-control UpperCase" id="baut2" name="baut2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="sem2" class="control-label">Seminarista:</label>
									<input type="number" class="form-control UpperCase" id="sem2" name="sem2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ast2" class="control-label">Ast. Iglesia:</label>
									<input type="number" class="form-control UpperCase" id="ast2" name="ast2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="fecha2" class="control-label">Fecha:</label>
									<input type="date" class="form-control UpperCase" id="fecha2" name="fecha2"  autocomplete="off" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" >
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