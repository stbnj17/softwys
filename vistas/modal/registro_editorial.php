<?php
if (isset($conexion)) {
?>
    <div id="nuevaEditorial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i> Nueva Editorial</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="guardar_editorial" name="guardar_editorial">
                        <div id="resultados_edit"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit2" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control UpperCase" id="edit2" name="edit2" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light" id="guardar_editorial">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
<?php
}
?>