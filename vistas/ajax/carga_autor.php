<?php
require_once "../db.php";
require_once "../php_conexion.php";
?>
<select class="form-control" id="autor" name="autor">
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