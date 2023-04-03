<?php
if (isset($conexion)) {
?>
    <div id="editarLibro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i> Editar Libro</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="editar_libro" name="editar_libro">
                        <div id="resultados_ajax2"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mod_titulo" class="control-label">Titulo:</label>
                                    <input type="text" class="form-control UpperCase" id="mod_titulo" name="mod_titulo" autocomplete="off" required>
                                    <input id="mod_id" name="mod_id" type='hidden'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mod_fecha" class="control-label">Fecha Lanzamiento:</label>
                                    <input type="date" class="form-control UpperCase" id="mod_fecha" name="mod_fecha" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo" class="control-label">Autor:</label>
                                    <select class="form-control" id="mod_autor" name="mod_autor">
                                        <option value="">-- Selecciona --</option>
                                        <?php

                                        $query_family = mysqli_query($conexion, "select * from autores order by autor");
                                        while ($rw = mysqli_fetch_array($query_family)) {
                                        ?>
                                            <option value="<?php echo $rw['id_autor']; ?>"><?php echo $rw['autor']; ?></option>
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
                                    <label for="tipo" class="control-label">Categoria: </label>
                                    <select class="form-control" id="mod_cat" name="mod_cat">
                                        <option value="">-- Selecciona --</option>
                                        <?php

                                        $query_family = mysqli_query($conexion, "select * from cat_libro order by categoria");
                                        while ($rw = mysqli_fetch_array($query_family)) {
                                        ?>
                                            <option value="<?php echo $rw['id_cat']; ?>"><?php echo $rw['categoria']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editorial" class="control-label">Editorial:</label>
                                    <select class="form-control" id="mod_editorial" name="mod_editorial">
                                        <option value="">-- Selecciona --</option>
                                        <?php

                                        $query_family = mysqli_query($conexion, "select id_editorial, editorial from editoriales order by editorial");
                                        while ($rw = mysqli_fetch_array($query_family)) {
                                        ?>
                                            <option value="<?php echo $rw['id_editorial']; ?>"><?php echo $rw['editorial']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mod_idioma" class="control-label">Idioma:</label>
                                    <input type="text" class="form-control UpperCase" id="mod_idioma" name="mod_idioma" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mod_paginas" class="control-label">Paginas:</label>
                                    <input type="text" class="form-control UpperCase" id="mod_paginas" name="mod_paginas" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mod_estado" class="control-label">Estado:</label>
                                    <select class="form-control" id="mod_estado" name="mod_estado" required>
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
                                    <label for="mod_descripcion" class="control-label">Descripción:</label>
                                    <textarea class="form-control UpperCase" id="mod_descripcion" name="mod_descripcion" maxlength="255" autocomplete="off"></textarea>
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