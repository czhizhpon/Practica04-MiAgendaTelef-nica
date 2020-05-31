<?php
    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';

    $cedula = isset($_POST["i_dni"]) ? trim($_POST["i_dni"]) : null;
    $nombres = isset($_POST["i_name"]) ? mb_strtoupper(trim($_POST["i_name"]), 'UTF-8') : null;
    $apellidos = isset($_POST["i_lastname"]) ? mb_strtoupper(trim($_POST["i_lastname"]), 'UTF-8') : null;
    $direccion = isset($_POST["i_address"]) ? mb_strtoupper(trim($_POST["i_address"]), 'UTF-8') : null;
    $correo = isset($_POST["i_email"]) ? trim($_POST["i_email"]): null;
    $fechaNacimiento = isset($_POST["i_born"]) ? trim($_POST["i_born"]): null;
    $contrasena = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;
    
    $sql = "INSERT INTO usuarios (usu_codigo, usu_cedula, usu_nombre, usu_apellido, 
    usu_direccion, usu_correo, usu_fecha_nacimiento, usu_password, usu_rol, 
    usu_eliminado, usu_fecha_creacion, usu_fecha_modificacion) 
    
    VALUES 

    (NULL, '$cedula', '$nombres', '$apellidos', '$direccion', 
    '$correo', '$fechaNacimiento', MD5('$contrasena'), 'U', 'N', 
    current_timestamp(), NULL);";

    $sqlUsu = "SELECT usuarios.usu_codigo FROM usuarios WHERE usuarios.usu_cedula = '$cedula'";
    
    if ($conn->query($sql) === TRUE) {

        $result = $conn -> query($sqlUsu);

        if($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            session_start();
            $_SESSION['usu_codigo'] = $row['usu_codigo'];
            $_SESSION['isAdmin'] = FALSE;
            $_SESSION["isLogged"] = TRUE;
            echo "sucess";
        }
        
    } else {
        if($conn->errno == 1062){
            echo "<p class='e_notice e_notice_error'>La cédula \"$cedula\", y/o el correo \"$correo\" ya están registrados en el sistema</p>";
        }else{
            echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    //cerrar la base de datos
    $conn->close();
?>