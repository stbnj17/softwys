<?php
if (isset($conexion)) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="password_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class='fa fa-unlock'></i> Cambiar contraseña</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" id="editar_password" name="editar_password">
              <div id="resultados_ajax3"></div>

              <div class="form-group">
                <label for="user_password_new3" class="col-sm-4 control-label">Nueva contraseña</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="user_password_new3" name="user_password_new3" placeholder="Nueva contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
                  <div class="outer_div3"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="user_password_repeat3" class="col-sm-4 control-label">Repite contraseña</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="user_password_repeat3" name="user_password_repeat3" placeholder="Repite contraseña" pattern=".{6,}" required>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-rounded waves-effect waves-light" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light" id="actualizar_datos3">Cambiar contraseña</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
}
?>