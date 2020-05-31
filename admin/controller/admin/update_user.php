<?php
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
    
    include '../../../config/conexionBD.php';

    $id = isset($_POST["user_code"]) ? trim($_POST["user_code"]) : null;
    $cedula = isset($_POST["i_dni"]) ? trim($_POST["i_dni"]) : null;
    $nombres = isset($_POST["i_name"]) ? mb_strtoupper(trim($_POST["i_name"]), 'UTF-8') : null;
    $apellidos = isset($_POST["i_lastname"]) ? mb_strtoupper(trim($_POST["i_lastname"]), 'UTF-8') : null;
    $direccion = isset($_POST["i_address"]) ? mb_strtoupper(trim($_POST["i_address"]), 'UTF-8') : null;
    $correo = isset($_POST["i_email"]) ? trim($_POST["i_email"]): null;
    $fechaNacimiento = isset($_POST["i_born"]) ? trim($_POST["i_born"]): null;
    $tipoUsuario = isset($_POST["usu_type"]) ? trim($_POST["usu_type"]): null;
    
    $sql = "UPDATE usuarios SET 
            usu_cedula = '$cedula', 
            usu_nombre = '$nombres', 
            usu_apellido = '$apellidos', 
            usu_direccion = '$direccion', 
            usu_correo = '$correo', 
            usu_fecha_nacimiento = '$fechaNacimiento', 
            usu_rol = '$tipoUsuario', 
            usu_fecha_modificacion = current_timestamp()
            WHERE usu_codigo = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='e_notice e_notice_sucess'>Se han actualizado los datos del usuario correctamente.</p>";
    } else {
        if($conn->errno == 1062){
            echo "<p class='e_notice e_notice_error'>La cédula \"$cedula\", y/o el correo \"$correo\" ya están registrados en el sistema</p>";
        }else{
            echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    
    $conn->close();
?>
