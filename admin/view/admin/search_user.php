<?php
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <!--
            Practica04-Mi Agenda Telefónica
            Página que responde a la funcionalidad de buscar un usuario
            dado su cédula o correo electrónico
            Authors: Bryan Sarmiento, Eduardo Zhizhpon
            Date: 29/05/2020

            Filename: search_user.php
        -->

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link rel="shortcut icon" href="../../../images/icons/logo.png"/>

        <link href="../../../css/main_format.css" rel="stylesheet">
        <link href="../../../css/table_layout.css" rel="stylesheet">
        <link href="../../../css/2_col_layout.css" rel="stylesheet"/>

        <title>Buscar Usuario</title>
    </head>

    <body>
        <header id="main_header">
            <div id="logo_container">
                <a href="index.php" id="img_logo">
                    <img src="../../../images/icons/logo.png" alt="Logo Game Specs"/>
                </a>

                <form id="f_search" action="search_user.php" method="POST">  
                    <input type="search" id="index_search" name="index_search" placeholder="Buscar por cédula o correo"/>
                </form>

                <a href="my_account.php" class="nav_icon">
                    <img src="../../../images/icons/user.png" alt="account logo"/>
                    <span>Cuenta</span>
                </a>

                <a href="#" class="nav_icon">
                    <img src="../../../images/icons/mail.png" alt="feedback logo"/>
                    <span>Feedback</span>
                </a>

                <a href="../../../config/close_session.php" class="nav_icon">
                    <img src="../../../images/icons/team.png" alt="about logo"/>
                    <span>Cerrar Sesión</span>
                </a>
            </div>

            <nav id="header_nav">
                <a class="nav_a" href="index.php">Inicio</a>
                <a class="nav_a" href="users.php">Registrar Usuarios</a>
                <a class="nav_a" href="show_users.php">Listar Usuarios</a>
                <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1">Administrar Usuarios</a>
                <a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
                <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
            </nav>  
        </header>


        <?php
            # Seccion PHP que se encarga de iniciar los datos.
            include '../../../config/conexionBD.php';
            $stringBusqueda = isset($_POST["index_search"]) ? trim($_POST["index_search"]) : null;
            
            $sqlUsuarios_cedula = "SELECT * FROM usuarios WHERE usu_eliminado = 'N' AND usu_cedula LIKE '$stringBusqueda'";
            $resultado_cedula = $conn->query($sqlUsuarios_cedula);

            $sqlUsuarios_correo = "SELECT * FROM usuarios WHERE usu_eliminado = 'N' AND usu_correo LIKE '$stringBusqueda'";
            $resultado_correo = $conn->query($sqlUsuarios_correo);
            
        ?>
        
        <main id="main_search" class="main_container center_container" >
            <section class="col col-100 form_section">
                <div class="table_container">
                    <table id="user_table" class="col-80 table_content">
                        <tr>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Fecha Nacimiento</th>
                        </tr>

                        <?php 
                            # Seccion de PHP donde se inserta los datos del usuario.
                            if ( $resultado_cedula->num_rows > 0 || $resultado_correo->num_rows > 0) {

                                if ($resultado_cedula->num_rows > 0) {
                                    $resultado = $resultado_cedula;
                                } else {
                                    $resultado = $resultado_correo;
                                }
                                
                                while ($row = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    $codigoUsuario = $row["usu_codigo"]; 
                                    echo " <td>" . $row["usu_cedula"] . "</td>";
                                    echo " <td>" . $row['usu_nombre'] ."</td>";
                                    echo " <td>" . $row['usu_apellido'] . "</td>";
                                    echo " <td>" . $row['usu_direccion'] . "</td>";
                                    echo " <td><a href='mailto:". $row['usu_correo'] . "'>" . $row['usu_correo'] . "</a></td>";
                                    echo " <td>" . date("d/m/Y", strtotime($row['usu_fecha_nacimiento'])) . "</td>";
                                    echo "</tr>";
                                }
                        ?>
                    </table>
                
                    <table id="phones_table" class="col-20 table_content">
                        <tr>
                            <th>Teléfonos</th>
                            <th>Operadora</th>
                        </tr>
                        <?php 
                            
                                # Seccion de PHP donde se inserta los telefonos del usuario.
                                $sqlTelefonos = "SELECT * FROM telefonos WHERE tel_eliminado = 'N' AND usu_codigo LIKE '$codigoUsuario'";
                                $telefonos = $conn->query($sqlTelefonos);

                                if ($telefonos->num_rows > 0) {
                                    while ($row = $telefonos->fetch_assoc()) {
                                        echo "<tr>";
                                        echo " <td><a class='a_link' href='tel:". $row['tel_numero'] . "'>" . $row["tel_numero"] . "</a></td>";
                                        echo " <td>" . $row["tel_operadora"] ."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo " <td colspan='2'> No existen teléfonos registrados en ese usuario </td>";
                                    echo "</tr>";
                                }
                            
                            } else {
                                echo "<tr>";
                                echo " <td colspan='7'> No existen usuarios registrados en el sistema con los parámetros establecidos </td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                <div>
            </section>
        </main>

        <footer id="pie">
            <div class="cont_pie">
                <div id="logo_pie">
                    <a href="https://www.facebook.com/" target="_blank"><img src="../../../images/icons/faceLogo.png" alt="Facebook Logo"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="../../../images/icons/instaLogo.png" alt="Instagram Logo"></a>
                </div>
                <img class="logo" src="../../../images/icons/logo.png" alt="LOGO">

                <p>
                    Universidad Politécnica Salesiana <br />
                    <br/>
                    Sarmiento Basurto Douglas Bryan <br/>
                    <span><strong>Correo :</strong><a href="mailto:dsarmientob1@est.ups.edu.ec"> dsarmientob1@est.ups.edu.ec</a></span> <br />
                    <br/>
                    Zhizhpon Tacuri Cesar Eduardo <br/>
                    <span><strong>Correo :</strong><a href="mailto:czhizhpon@est.ups.edu.ec"> czhizhpon@est.ups.edu.ec</a></span> <br />
                    <br/>
                    &copy; Todos los derechos reservados
                </p>
            </div>

            <div class="cont_pie">
                <fieldset>
                    <legend>Gestión de Usuarios</legend>
                    <nav>
                    <a class="nav_a" href="users.php">Registrar Usuarios</a>
                    <a class="nav_a" href="show_users.php">Listar Usuarios</a>
                    <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1">Administrar usuarios</a>
                    </nav>
                </fieldset>
            </div>

            <div class="cont_pie">
                <fieldset>
                    <legend>Gestión de Teléfonos</legend>
                    <nav>
                        <a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
                        <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
                    </nav>
                </fieldset>
            </div>
        </footer>

        <?php
            # Cerrar la conexión a la base de Datos
            $conn->close();
        ?>
    </body>
</html>