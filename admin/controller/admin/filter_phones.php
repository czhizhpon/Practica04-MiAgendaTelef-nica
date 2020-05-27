<?php
    include '../../../config/conexionBD.php';

    $keyword = $_GET['keyword'];
    $sqlPhones = "SELECT * FROM telefonos LEFT JOIN usuarios ON telefonos.usu_codigo = usuarios.usu_codigo where (
        tel_numero like '%$keyword%' or
        tel_operadora like '%$keyword%' or
        tel_tipo like '%$keyword'
        )";
    
    $resultPh = $conn->query($sqlPhones);

    echo "<tr>
            <th>Número</th>
            <th>Tipo</th>
            <th>Operadora</th>
            <th>Eliminado</th>
            <th>U. Modificación</th>
            <th>CI. Usuario</th>
        </tr>";

    if($resultPh){
        if ($resultPh -> num_rows > 0) {

            while($rowPh = $resultPh -> fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='tel:". $rowPh['tel_numero'] . "'>" . $rowPh['tel_numero'] . "</a></td>";
                switch($rowPh['tel_tipo']){
                    case "CO":
                        echo "<td> CONVENCIONAL</td>";
                    break;
                    case "CE":
                        echo "<td> CELULAR</td>";
                    break;

                    default:

                }
                echo "<td>" . $rowPh['tel_operadora'] . "</td>";
                echo "<td>" . $rowPh['tel_eliminado'] . "</td>";
                echo "<td>" . $rowPh['tel_fecha_modificacion'] . "</td>";
                echo "<td>" . $rowPh['usu_cedula'] . "</td>";
                echo "<td> <a class='btn' onclick='readAdminPhone(\"f_phone\", ". $rowPh['tel_codigo'] .")'>Administrar</a></td>";
                echo "</tr>";
                
            }
        } else {
            echo "<tr>";
            echo " <td colspan='5'> No se encontró.</td>";
        }
    }else{
        echo " <tr><td colspan='5'>Error: " . mysqli_error($conn) . "</td></tr>";
        echo "</tr>";
    }
    
    $conn->close();
?>