<?php 
    session_start();
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["i_email"]) ? trim($_POST["i_email"]) : null;
    $password = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;

    $sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and 
    usu_password = MD5('$password');";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0){
        $_SESSION["isLogged"] = TRUE;
        header("Location: ../../admin/vista/usuario/index.php");
    }else{
        header("Location: ../vista/login.html");
    }

    $conn -> close();
?>