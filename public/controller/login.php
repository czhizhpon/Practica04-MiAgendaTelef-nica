<?php 
    session_start();
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["i_email"]) ? trim($_POST["i_email"]) : null;
    $password = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;

    $sql = "SELECT * FROM usuarios WHERE usu_correo = '$usuario' and 
    usu_password = MD5('$password');";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0){
        $_SESSION["isLogged"] = TRUE;
        $row = $result -> fetch_assoc();

        if($row["usu_rol"] === "A"){
            $_SESSION['isAdmin'] = TRUE;
            header("Location: ../../admin/view/admin/index.php?codigo=" . $row['usu_codigo']);
            
        }else{
            $_SESSION['isAdmin'] = FALSE;
            header("Location: ../../admin/view/user/index.php?codigo=" . $row['usu_codigo']);
        }

        
    }else{
        header("Location: ../view/login.html");
    }

    $conn -> close();
?>