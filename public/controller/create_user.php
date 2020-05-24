<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear Nuevo Usuario</title>
    </head>
    <body>
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

            
          
            if ($conn->query($sql) === TRUE) {
                echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
            } else {
                if($conn->errno == 1062){
                    echo "<p class='error'>La persona con la cédula $cedula o el correo $correo ya estan registrados en el sistema</p>";
                }else{
                    echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
                }
                echo "ERROR";
            }
            //cerrar la base de datos
            $conn->close();
            echo "<a href='../view/create_user.html'>Regresar</a>";
        ?>
    </body>
</html>