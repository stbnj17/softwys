<?php
if (isset($_REQUEST['id_consulta'])) {
    $id_consulta = intval($_REQUEST['id_consulta']);
    ?>
	<div class="alert alert-info">
		<strong>Ojo!</strong> Realizar Cobro de la consulta No. <strong><?php echo $id_consulta; ?></strong>
	</div>
	<div class="form-group" align="center">
		<label for="monto" class="control-label">Dinero Recibido</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="monto" name="monto" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" required autocomplete="off">
			<input value="<?php echo $id_consulta; ?>" type="hidden" name="id_consulta" id="id_consulta">
		</div>
	</div>
	<?php }?>