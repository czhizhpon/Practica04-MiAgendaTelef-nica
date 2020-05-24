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
            $telefono = isset($_POST["i_phone_number"]) ? trim($_POST["i_phone_number"]): null;
            $correo = isset($_POST["i_email"]) ? trim($_POST["i_email"]): null;
            $fechaNacimiento = isset($_POST["i_born"]) ? trim($_POST["i_born"]): null;
            $contrasena = isset($_POST["i_password"]) ? trim($_POST["i_password"]) : null;
            
            $sql = "INSERT INTO usuario VALUES (0, '$cedula', '$nombres', '$apellidos', '$direccion', '$telefono',
            '$correo', MD5('$contrasena'), '$fechaNacimiento', 'N', null, null)";
            
            if ($conn->query($sql) === TRUE) {
                echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
            } else {
                if($conn->errno == 1062){
                    echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
                }else{
                    echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
                }
                echo "ERROR";
            }

            //cerrar la base de datos
            $conn->close();
            echo "<a href='../vista/crear_usuario.html'>Regresar</a>";
        ?>
    </body>
</html>