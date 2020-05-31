<?php 
    session_start();
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["i_email"]) ? trim($_POST["i_email"]) : null;
    $password = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;

    $sql = "SELECT * FROM usuarios WHERE usu_correo = '$usuario' and 
    usu_password = MD5('$password');";

    $result = $conn -> query($sql);

    if($result->num_rows > 0){
        $_SESSION["isLogged"] = TRUE;

        $row = $result -> fetch_assoc();
        $_SESSION['usu_codigo'] = $row['usu_codigo'];

        if($row["usu_rol"] === "A"){
            $_SESSION['isAdmin'] = TRUE;
            echo "sucess:../../admin/view/admin/index.php";
            
        }else{
            $_SESSION['isAdmin'] = FALSE;
            echo "sucess:../../admin/view/user/index.php";
        }
        
    }else{
        echo "<p class='e_notice e_notice_error'>No se encontraron sus credenciales en el sistema.</p>";
    }

    $conn -> close();
?>