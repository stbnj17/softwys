<?php
if (isset($_GET['term'])) {
    include "../../db.php";
    include "../../php_conexion.php";
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($conexion) {

        $fetch = mysqli_query($conexion, "SELECT * FROM pacientes where nombre_paciente like '%" . mysqli_real_escape_string($conexion, ($_GET['term'])) . "%' LIMIT 0 ,50");

        /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {
            $id_cliente                    = $row['id_paciente'];
            $row_array['value']            = $row['nombre_paciente'];
            $row_array['id_paciente']      = $id_cliente;
            $row_array['nombre_paciente']  = $row['nombre_paciente'];
            $row_array['fecha_nacimiento'] = $row['fecha_nacimiento'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($conexion);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
