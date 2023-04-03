<?php
if (isset($_GET['term'])) {
    include "../../db.php";
    include "../../php_conexion.php";
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($conexion) {

        $fetch = mysqli_query($conexion, "SELECT * FROM miembros where nombre_miembro like '%" . mysqli_real_escape_string($conexion, ($_GET['term'])) . "%' LIMIT 0 ,50");

        /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {
            $id_cliente                  = $row['id_miembro'];
            $row_array['value']          = $row['nombre_miembro'] . ' ' . $row['apellido_miembro'];
            $row_array['id_miembro']     = $id_cliente;
            $row_array['nombre_miembro'] = $row['nombre_miembro'] . ' ' . $row['apellido_miembro'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($conexion);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
