<?php
    include '../../../config/conexionBD.php';

    $admin_id = $_GET['admin_id'];
    $user_id = $_GET['user_id'];
    $state = $_GET['state'];

    date_default_timezone_set("America/Guayaquil");
    $date = date('Y-m-d H:i:s', time());

    $sql = "UPDATE usuarios SET usu_eliminado = '$state', usu_fecha_modificacion = '$date' WHERE usu_codigo = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Se ha cambiado el estado correctamentee!!!</p>";
    } else {
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
    
    $conn->close();
?>