<?php
require_once "../db.php";
require_once "../php_conexion.php";
?>
<select class="form-control" id="cat" name="cat">
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