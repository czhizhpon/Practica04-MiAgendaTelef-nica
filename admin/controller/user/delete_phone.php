<?php
    include '../../../config/conexionBD.php';

    $tel_codigo = $_GET["tel_codigo"];
    // echo "<h1>" . $tel_codigo. "</h1>";
    $tel_fecha_modificacion = date('Y-m-d H:i:s', time());

    $sql = "UPDATE telefonos SET " .
    "tel_fecha_modificacion = '$tel_fecha_modificacion', " .
    "tel_eliminado = 'E' " .
    "WHERE telefonos.tel_codigo = $tel_codigo";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Se eliminó el teléfono.</p>";
    } else {
        if($conn->errno == 1062){
            echo "<p class='error'></p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    //cerrar la base de datos
    $conn->close();
?>
