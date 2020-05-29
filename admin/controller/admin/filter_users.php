<?php
    include '../../../config/conexionBD.php';

    $admin_id = $_GET['admin_id'];
    $action = $_GET['action'];
    $key = trim($_GET['key']);

    if ($key == "" && $action !=0) {
        $action = 2;
    }
        
    $sqlAllUsers = "SELECT * FROM usuarios WHERE usu_codigo NOT LIKE '$admin_id' AND
                 (usu_cedula LIKE '%$key%' OR
                 usu_nombre LIKE '%$key%' OR
                 usu_apellido LIKE '%$key%' OR
                 usu_direccion LIKE '%$key%' OR
                 usu_correo LIKE '%$key%' OR
                 usu_fecha_nacimiento LIKE '%$key%' OR
                 usu_rol LIKE '[$key]')";
                 # Nota> Ojo con la consulta del rol.

    $sqlActiveUsers = "SELECT * FROM usuarios WHERE usu_codigo NOT LIKE '$admin_id' AND 
                usu_eliminado LIKE 'N' AND
                (usu_cedula LIKE '%$key%' OR
                usu_nombre LIKE '%$key%' OR
                usu_apellido LIKE '%$key%' OR
                usu_direccion LIKE '%$key%' OR
                usu_correo LIKE '%$key%' OR
                usu_fecha_nacimiento LIKE '%$key%' OR
                usu_rol LIKE '[$key]')";

    $sqlEmpty = "SELECT * FROM usuarios WHERE usu_codigo LIKE '$key'";

    $table_head = " <tr>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Direccion</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th></th>
                    </tr> ";

    if ($action == 0) {
        $sql = $sqlActiveUsers;
    } else if ($action == 1) {
        $sql = $sqlAllUsers;
        $table_head = " <tr>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Direccion</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr> ";
    } else {
        $sql = $sqlEmpty;
    }
    

    $resultUs = $conn->query($sql);

    echo $table_head;

    if ($resultUs) {

        if ($resultUs->num_rows > 0) {

            while ($rowUs = $resultUs->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $rowUs['usu_cedula'] ."</td>";
                echo "<td>". $rowUs['usu_nombre'] ."</td>";
                echo "<td>". $rowUs['usu_apellido'] ."</td>";
                echo "<td>". $rowUs['usu_direccion'] ."</td>";
                echo "<td>". date("d/m/Y", strtotime($rowUs['usu_fecha_nacimiento'])) ."</td>";
                echo " <td><a href='mailto:". $rowUs['usu_correo'] . "'>" . $rowUs['usu_correo'] . "</a></td>";

                switch ($rowUs['usu_rol']) {
                    case 'U':
                        echo "<td>Usuario</td>";
                        break;
                    case 'A':
                        echo "<td>Administrador</td>";
                        break;
                    default:
                        echo "<td>Desconocido</td>";
                        break;
                }

                switch ($rowUs['usu_eliminado']) {
                    case 'N':
                        $estado = "Activo";
                        break;
                    case 'E':
                        $estado = "Eliminado";
                        break;
                    default:
                        $estado = "Desconocido";
                        break;
                }
                
                switch ($action) {
                    case 0:
                        echo "<td><a class=\"btn btn_passive\" href='manage_users.php?codigo=". $admin_id ."&usu_id=". $rowUs['usu_codigo'] ."&readAction=1'>Gestionar Usuario</a></td>";
                        break;
                    case 1:
                        echo "<td>". $estado ."</td>";
                        if ($rowUs['usu_eliminado'] == 'N') {
                            echo "<td> <a class='btn btn_danger' onclick='deleteUser(". $rowUs['usu_codigo'] .")'>Eliminar</a></td>";
                        } else {
                            echo "<td> <a class='btn btn_passive' onclick='restoreUser(". $rowUs['usu_codigo'] .")'>Restaurar</a></td>";
                        }
                        echo "<td> <a class='btn btn_passive' onclick='readUser(\"f_personal_data\", ". $rowUs['usu_codigo'] .", 1)'>Actualizar Usuario</a></td>";
                        echo "<td> <a class='btn btn_passive' onclick='readUser(\"f_password\", ". $rowUs['usu_codigo'] .", 2)'>Restablecer Contraseña</a></td>";
                        break;                 
                    default:
                        # code...
                        break;
                }

                echo "</tr>";
            }
        
        } else {
            echo "<tr>";
            echo "<td colspan='11'> No existen usuarios registrados con los criterios de busqueda.</td>";
        }

    } else {
        echo " <tr><td colspan='8'>Error: " . mysqli_error($conn) . "</td></tr>";
        echo "</tr>";
    }
    
    $conn->close();
?>