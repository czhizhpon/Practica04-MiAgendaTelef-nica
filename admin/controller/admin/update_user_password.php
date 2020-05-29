<?php
    include '../../../config/conexionBD.php';

    $id = isset($_POST["user_code"]) ? trim($_POST["user_code"]) : null;
    $password = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;
    
    $sql = "UPDATE usuarios SET 
            usu_password = MD5('$password'),
            usu_fecha_modificacion = current_timestamp()
            WHERE
            usu_codigo = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='e_notice e_notice_sucess'>Se ha actualizado la contraseña del usuario correctamente.</p>";
    } else {
        echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
    }
    
    $conn->close();
?>