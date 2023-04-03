<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="../ajax/editEventTitle.php" id="editar_cita" name="editar_cita">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Modificar Seminario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <textarea name="title" class="form-control" id="title" maxlength="255" autocomplete="off" placeholder="Escriba el Nombre"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color" class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-10">
                            <select name="color" class="form-control" id="color">
                                <option value="">Seleccionar</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                <option style="color:#000;" value="#000">&#9724; Negro</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-3 col-9">
                            <div class="checkbox checkbox-danger">
                                <input id="checkbox2" type="checkbox" name="delete">
                                <label for="checkbox2">
                                    Eliminar Seminario!
                                </label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" class="form-control" id="id">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="actualizar_datos">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>