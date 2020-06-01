<?php

    session_start();

    $user_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === TRUE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }

    include '../../../config/conexionBD.php';

    $tel_codigo = $_GET["tel_codigo"];
    $tel_fecha_modificacion = date('Y-m-d H:i:s', time());

    $sql = "UPDATE telefonos SET " .
    "tel_fecha_modificacion = '$tel_fecha_modificacion', " .
    "tel_eliminado = 'E' " .
    "WHERE telefonos.tel_codigo = $tel_codigo";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='e_notice e_notice_sucess'>Se eliminó el teléfono.</p>";
    } else {
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
    //cerrar la base de datos
    $conn->close();
?>
