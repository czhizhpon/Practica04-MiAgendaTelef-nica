<?php

    session_start();
    $user_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }

    include '../../../config/conexionBD.php';

    $cond = TRUE;

    $currentPassword = isset($_POST["currentMD5"]) ? trim($_POST["currentMD5"]) : null;

    $id = isset($_POST["user_code"]) ? trim($_POST["user_code"]) : null;

    if ( !is_null($currentPassword) ) {
        $oldPassword = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;
        $newPassword = isset($_POST["i_password_2"]) ? trim($_POST["i_password_2"]) : null;

        if (MD5($oldPassword) != $currentPassword) {
            $cond = FALSE;
            echo "<p class='e_notice e_notice_error'>Ingrese correctamente su contraseña anterior.</p>";
        } else if ($oldPassword == $newPassword) {
            $cond = FALSE;
            echo "<p class='e_notice e_notice_error'>Ingrese una contraseña diferente a la actual.</p>";
        } else {
            $password = $newPassword;
        }

    } else {
        $password = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;
    }

    if ($cond === TRUE) {

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

    }
    
    $conn->close();
?>