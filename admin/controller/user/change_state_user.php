<?php
    
    session_start();
    $user_id = $_SESSION['usu_codigo'];
    
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }

    include '../../../config/conexionBD.php';

    date_default_timezone_set("America/Guayaquil");
    $date = date('Y-m-d H:i:s', time());

    $sql = "UPDATE usuarios SET usu_eliminado = 'E', usu_fecha_modificacion = '$date' WHERE usu_codigo = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "sucess";
    } else {
        echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
    }
    
    $conn->close();
?>