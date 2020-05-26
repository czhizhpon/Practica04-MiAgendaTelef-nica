<?php
    include '../../../config/conexionBD.php';

    $admin_id = $_GET['admin_id'];
    
    $sqlUsers = "SELECT * FROM usuarios WHERE usu_codigo NOT LIKE '$admin_id'";

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
                echo "<td>". $rowUs['usu_fecha_nacimiento'] ."</td>";
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