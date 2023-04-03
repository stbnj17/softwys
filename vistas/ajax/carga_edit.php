<?php
require_once "../db.php";
require_once "../php_conexion.php";
?>
<select class="form-control" id="editorial" name="editorial">
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