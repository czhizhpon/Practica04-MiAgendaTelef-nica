<?php

    session_start();
    $user_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }

    include '../../../config/conexionBD.php';

    $tel_codigo = isset($_POST["i_phone_id"]) ? trim($_POST["i_phone_id"]): null;
    $tel_numero = isset($_POST["i_phone_number"]) ? trim($_POST["i_phone_number"]): null;
    $tel_tipo = isset($_POST["tel_type"]) ? mb_strtoupper(trim($_POST["tel_type"]), 'UTF-8') : null;
    $tel_operadora = isset($_POST["s_company"]) ? mb_strtoupper(trim($_POST["s_company"]), 'UTF-8') : null;

    $tel_fecha_modificacion = date('Y-m-d H:i:s', time());

    $sql = "UPDATE telefonos SET " .
    "tel_numero = '$tel_numero', " .
    "tel_tipo = '$tel_tipo', " .
    "tel_operadora = '$tel_operadora', " .
    "tel_fecha_modificacion = '$tel_fecha_modificacion' " .
    "WHERE telefonos.tel_codigo = $tel_codigo";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='e_notice e_notice_sucess'>Se han actualizado los datos del teléfono correctamemte.</p>";
    } else {
        if($conn->errno == 1062){
            echo "<p class='e_notice e_notice_error'>El número \"$tel_numero\" ya están registrados en el sistema</p>";
        }else{
            echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    //cerrar la base de datos
    $conn->close();
?>
