<?php
    
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }

    include '../../../config/conexionBD.php';

    $admin_id = $_GET['admin_id'];
    $user_id = $_GET['user_id'];
    $state = $_GET['state'];

    date_default_timezone_set("America/Guayaquil");
    $date = date('Y-m-d H:i:s', time());

    $sql = "UPDATE usuarios SET usu_eliminado = '$state', usu_fecha_modificacion = '$date' WHERE usu_codigo = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='e_notice e_notice_sucess'>Se ha actualizado el estado del usuario correctamente.</p>";
    } else {
        echo "<p class='e_notice e_notice_error'>Error: " . mysqli_error($conn) . "</p>";
    }
    
    $conn->close();
?>