<?php
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
    
    include '../../../config/conexionBD.php';

    $tel_codigo = isset($_POST["i_phone_id"]) ? trim($_POST["i_phone_id"]): null;
    $tel_numero = isset($_POST["i_phone_number"]) ? trim($_POST["i_phone_number"]): null;
    $tel_tipo = isset($_POST["tel_type"]) ? mb_strtoupper(trim($_POST["tel_type"]), 'UTF-8') : null;
    $tel_operadora = isset($_POST["s_company"]) ? mb_strtoupper(trim($_POST["s_company"]), 'UTF-8') : null;
    $tel_eliminado = isset($_POST["i_check_tel_eliminado"]) ? mb_strtoupper(trim($_POST["i_check_tel_eliminado"]), 'UTF-8') : null;
    $user_cedula = isset($_POST["i_user_dni"]) ? mb_strtoupper(trim($_POST["i_user_dni"]), 'UTF-8') : null;

    $tel_fecha_modificacion = date('Y-m-d H:i:s', time());

    if($tel_eliminado == ""){
        $tel_eliminado = "N";
    }

    $sqlUsuario = "SELECT * FROM usuarios where usu_cedula = '$user_cedula'";
    $resultUsu = $conn -> query($sqlUsuario);
    if($resultUsu){
        if($resultUsu -> num_rows > 0){
            while($rowUsu = $resultUsu -> fetch_assoc()) {
                $usu_codigo = $rowUsu['usu_codigo'];
            }

            $sql = "UPDATE telefonos SET " .
            "tel_numero = '$tel_numero', " .
            "tel_tipo = '$tel_tipo', " .
            "tel_operadora = '$tel_operadora', " .
            "tel_fecha_modificacion = '$tel_fecha_modificacion', " .
            "tel_eliminado = '$tel_eliminado', " .
            "usu_codigo = '$usu_codigo' " .
            "WHERE telefonos.tel_codigo = $tel_codigo";
            
            if ($conn->query($sql) === TRUE) {
                echo "<p class='e_notice e_notice_sucess'>Se han actualizado los datos del teléfono correctamemte.</p>";
            } else {
                if($conn->errno == 1062){
                    echo "<p class='e_notice e_notice_error'>El número \"$tel_numero\" ya está registrado en el sistema.</p>";
                }
            }
        }else{
            echo "<p class='e_notice e_notice_error'> La cédula " . $user_cedula . " no está registrada en el sistema</p>";
        }
    }else{
            echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
    }
    //cerrar la base de datos
    $conn->close();
?>
