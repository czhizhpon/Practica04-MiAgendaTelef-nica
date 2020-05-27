<?php
    include '../../../config/conexionBD.php';

    $admin_id = $_GET['admin_id'];
    $action = $_GET['action'];

    $sqlUsers = "SELECT * FROM usuarios WHERE usu_codigo NOT LIKE '$admin_id' AND usu_eliminado LIKE 'N'";
    
    $resultUs = $conn->query($sqlUsers);

    echo " <tr>
            <th>Cedula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Direccion</th>
            <th>Fecha Nacimiento</th>
            <th>Correo</th>
            <th>Tipo</th>
          </tr> ";

    if ($resultUs) {
        
        if ($resultUs->num_rows > 0) {

            while ($rowUs = $resultUs->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $rowUs['usu_cedula'] ."</td>";
                echo "<td>". $rowUs['usu_nombre'] ."</td>";
                echo "<td>". $rowUs['usu_apellido'] ."</td>";
                echo "<td>". $rowUs['usu_direccion'] ."</td>";
                echo "<td>". date("d/m/Y", strtotime($rowUs['usu_fecha_nacimiento'])) ."</td>";
                echo "<td>". $rowUs['usu_correo'] ."</td>";

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

                switch ($action) {
                    case 0:
                        echo "<td><a class=\"btn\" href='manage_users.php?codigo=". $admin_id ."&usu_id=". $rowUs['usu_codigo'] ."'></a>Gestionar Usuario</td>";
                        break;
                    case 1:
                        # code...
                        break;                   
                    default:
                        # code...
                        break;
                }

                echo "</tr>";
            }
        
        } else {
            echo "<tr>";
            echo "<td colspan='7'> No existen usuarios registrados.</td>";
        }

    } else {
        echo " <tr><td colspan='7'>Error: " . mysqli_error($conn) . "</td></tr>";
        echo "</tr>";
    }
    
    $conn->close();
?>