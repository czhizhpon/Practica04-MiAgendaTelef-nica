<?php
    include '../../../config/conexionBD.php';

    $codigo_usuario = isset($_POST["i_user_codigo"]) ? trim($_POST["i_user_codigo"]): null;
    $numero = isset($_POST["i_phone_number"]) ? trim($_POST["i_phone_number"]): null;
    $tipo = isset($_POST["tel_type"]) ? mb_strtoupper(trim($_POST["tel_type"]), 'UTF-8') : null;
    $compania = isset($_POST["s_company"]) ? mb_strtoupper(trim($_POST["s_company"]), 'UTF-8') : null;

    $sql = "INSERT INTO telefonos (tel_codigo, tel_numero, tel_tipo, tel_operadora, tel_eliminado, 
        tel_fecha_creacion, tel_fecha_modificacion, usu_codigo) 
        VALUES 
        (NULL, '$numero', '$tipo', '$compania', 'N', current_timestamp(), NULL, '$codigo_usuario');";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
    } else {
        if($conn->errno == 1062){
            echo "<p class='error'>La número $numero ya están registrados en el sistema</p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    //cerrar la base de datos
    $conn->close();
?>
