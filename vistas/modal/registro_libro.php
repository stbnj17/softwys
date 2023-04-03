<?php
if (isset($conexion)) {
?>
    <div id="nuevoLibro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Libro</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="guardar_libro" name="guardar_libro">
                        <div id="resultados_ajax"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="titulo" class="control-label">Titulo:</label>
                                    <input type="text" class="form-control UpperCase" id="titulo" name="titulo" autocomplete="off" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha" class="control-label">Fecha Lanzamiento:</label>
                                    <input type="date" class="form-control UpperCase" id="fecha" name="fecha" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo" class="control-label">Autor: <button type="button" class="btn btn-link" data-toggle="modal" data-target="#nuevoAutor"><i class="fa fa-plus"></i></button></label>
                                    <div id="load_autor"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo" class="control-label">Categoria: <button type="button" class="btn btn-link" data-toggle="modal" data-target="#nuevaCat"><i class="fa fa-plus"></i></button></label>
                                    <div id="load_cat"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editorial" class="control-label">Editorial: <button type="button" class="btn btn-link" data-toggle="modal" data-target="#nuevaEditorial"><i class="fa fa-plus"></i></button></label>
                                    <div id="load_edit"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="idioma" class="control-label">Idioma:</label>
                                    <input type="text" class="form-control UpperCase" id="idioma" name="idioma" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paginas" class="control-label">Paginas:</label>
                                    <input type="text" class="form-control UpperCase" id="paginas" name="paginas" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado" class="control-label">Estado:</label>
                                    <select class="form-control" id="estado" name="estado" required>
                                        <option value="">-- Selecciona --</option>
                                        <option value="1" selected>Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion" class="control-label">Descripción:</label>
                                    <textarea class="form-control UpperCase" id="descripcion" name="descripcion" maxlength="255" autocomplete="off"></textarea>
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