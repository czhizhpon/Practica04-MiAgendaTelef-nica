<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../../css/main_format.css" rel="stylesheet"/>
    <title>Buscar Usuario</title>
</head>
<body>
    <header id="main_header">
            
        <div id="logo_container">

            <a href="index.html" id="img_logo">
                <img src="../../images/icons/logo.png" alt="Logo Game Specs"/>
            </a>

            <form id="f_search" action="search_user.php" method="POST">  
                <input type="search" id="index_search" name="index_search" placeholder="Buscar"/>
            </form>

            <a href="#" class="nav_icon">
                <img src="../../images/icons/user.png" alt="account logo"/>
                <span>Cuenta</span>
            </a>
            <a href="#" class="nav_icon">
                <img src="../../images/icons/mail.png" alt="feedback logo"/>
                <span>Feedback</span>
            </a>
            <a href="#" class="nav_icon">
                <img src="../../images/icons/team.png" alt="about logo"/>
                <span>About</span>
            </a>

        </div>

        <nav id="header_nav">
            <a class="nav_a" href="index.html">Inicio</a>
            <a class="nav_a" href="#">Pendiente 1</a>
            <a class="nav_a" href="#">Pendiente 2</a>
            <a class="nav_a" href="#">Pendiente 3</a>
            <a class="nav_a" href="#">Pendiente 4</a>
            <a class="nav_a" href="#">Pendiente 5</a>
            <a class="nav_a" href="#">Pendiente 6</a>
            <a class="nav_a" href="#">Pendiente 7</a>
        </nav>
        
    </header>
    <!-- Fin Barra Nav   -->


    <?php
        # Seccion PHP que se encarga de iniciar los datos.
        include '../../config/conexionBD.php';
        $stringBusqueda = isset($_POST["index_search"]) ? trim($_POST["index_search"]) : null;
        
        $sqlUsuarios_cedula = "SELECT * FROM usuarios WHERE usu_eliminado = 'N' AND usu_cedula LIKE '$stringBusqueda'";
        $resultado_cedula = $conn->query($sqlUsuarios_cedula);

        $sqlUsuarios_correo = "SELECT * FROM usuarios WHERE usu_eliminado = 'N' AND usu_correo LIKE '$stringBusqueda'";
        $resultado_correo = $conn->query($sqlUsuarios_correo);
        
    ?>
    
    <main id="main_search" >

        <table id="user_table">
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
                        echo " <td>" . $row['usu_correo'] . "</td>";
                        echo " <td>" . $row['usu_fecha_nacimiento'] . "</td>";
                        echo "</tr>";
                    }
            ?>
        </table>

        <table id="phones_table">
            <tr>
                <th>Teléfonos</th>
            </tr>
            <?php 
                # Seccion de PHP donde se inserta los telefonos del usuario.
                $sqlTelefonos = "SELECT * FROM telefonos WHERE tel_eliminado = 'N' AND usu_codigo LIKE '$codigoUsuario'";
                $telefonos = $conn->query($sqlTelefonos);

                if ($telefonos->num_rows > 0) {
                    while ($row = $telefonos->fetch_assoc()) {
                        echo "<tr>";
                        echo " <td>" . $row["tel_numero"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo " <td> No existen teléfonos registrados en ese usuario </td>";
                    echo "</tr>";
                }
                
            } else {
                echo "<tr>";
                echo " <td colspan='7'> No existen usuarios registrados en el sistema con los parámetros establecidos </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>

    <?php
        # Cerrar la conexión a la base de Datos
        $conn->close();
    ?>

    <footer id="pie">
        <div class="cont_pie">
            <div id="logo_pie">
                <a href="https://www.facebook.com/" target="_blank"><img src="../../images/icons/faceLogo.png" alt="Facebook Logo"></a>
                <a href="https://www.instagram.com/" target="_blank"><img src="../../images/icons/instaLogo.png" alt="Instagram Logo"></a>
            </div>
            <img src="images/logoSO.png" alt="">

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
                <legend>Acerca de Cuenca</legend>
                <nav>
                    <a href="docs/historia.html" > Historia </a>
                    <a href="docs/geografia.html" > Geografía </a>
                    <a href="docs/cultura.html" > Cultura </a>
                    <a href="docs/turismo.html" > Turismo </a>
                </nav>
            </fieldset>
        </div>

        <div class="cont_pie">
            <fieldset>
                <legend>Universidades Principales</legend>
                <nav>
                    <a href="docs/educacion.html#ups" > Universidad Politécnica Salesiana </a>
                    <a href="docs/educacion.html#ucuenca" > Universidad Estatal de Cuenca </a>
                    <a href="docs/educacion.html#uda" > Universidad del Azuay </a>
                    <a href="docs/educacion.html#ucacue" > Universidad Católica de Cuenca </a>
                </nav>
            </fieldset>
        </div>
    </footer>
</body>
</html>