<?php
    include '../../../config/conexionBD.php';

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

            $sql = "INSERT INTO telefonos (tel_codigo, tel_numero, tel_tipo, tel_operadora, tel_eliminado, 
        tel_fecha_creacion, tel_fecha_modificacion, usu_codigo) 
        VALUES 
        (NULL, '$tel_numero', '$tel_tipo', '$tel_operadora', '$tel_eliminado', current_timestamp(), NULL, '$usu_codigo');";
            
            if ($conn->query($sql) === TRUE) {
                echo "<p>Se creó el teléfono correctamemte.</p>";
            } else {
                if($conn->errno == 1062){
                    echo "<p class='error'>El número \"$tel_numero\" ya está registrados en el sistema</p>";
                }
            }
        }else{
            echo "<p class='error'> La cédula " . $user_cedula . " no está registrada en el sistema</p>";
        }
    }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
    //cerrar la base de datos
    $conn->close();
?>
