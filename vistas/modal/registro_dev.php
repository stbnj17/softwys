<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoDev" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Control</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_dev" name="guardar_dev">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="evento" class="control-label">Evento:</label>
									<input type="text" class="form-control UpperCase" id="evento" name="evento" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="fecha" class="control-label">Fecha:</label>
									<input type="date" class="form-control UpperCase" id="fecha" name="fecha" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off" require>
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="varones" class="control-label">Varones:</label>
									<input type="number" class="form-control UpperCase" id="varones" name="varones" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="hembras" class="control-label">Hembras:</label>
									<input type="number" class="form-control UpperCase" id="hembras" name="hembras" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
								</div>
							</div>
                            <div class="col-md-3">
								<div class="form-group">
									<label for="ninos" class="control-label">Niños:</label>
									<input type="number" class="form-control UpperCase" id="ninos" name="ninos" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
								</div>
							</div>
                            <div class="col-md-3">
								<div class="form-group">
									<label for="ofrenda" class="control-label">Ofrenda:</label>
									<input type="text" class="form-control UpperCase" id="ofrenda" name="ofrenda" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
								</div>
							</div>
						</div>

                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="conv" class="control-label">Conv.</label>
									<input type="number" class="form-control UpperCase" id="conv" name="conv" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
								</div>
							</div>
                            <div class="col-md-3">
								<div class="form-group">
									<label for="rec" class="control-label">Rec.</label>
									<input type="number" class="form-control UpperCase" id="rec" name="rec" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
								</div>
							</div>
                            <div class="col-md-3">
								<div class="form-group">
									<label for="btm" class="control-label">Bautismos:</label>
									<input type="number" class="form-control UpperCase" id="btm" name="btm" style=" background-color:#EAF2F8; border-radius: 5px; border: 1px solid #39c; text-align:center;" autocomplete="off">
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