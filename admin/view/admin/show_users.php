<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="../../../css/form_layout.css" rel="stylesheet"/>
        <link href="../../../css/main_format.css" rel="stylesheet"/>
        <script src="../../../js/create_user_validation.js"></script>
        <title>Visualizar Usuarios - Admin</title>
    </head>
    <body>
    <?php
		$usu_id = $_GET["codigo"];
	?>
        <header id="main_header">
                
            <div id="logo_container">

                <a href="index.html?codigo=<?php echo $usu_id; ?>" id="img_logo">
                    <img src="../../../images/icons/logo.png" alt="Logo Game Specs"/>
                </a>

                <!--Pendiente de revisar esta barra de busqueda-->
                <form id="f_search" action="../../../public/view/search_user.php" method="POST">  
                        <input type="search" id="index_search" name="index_search" placeholder="Buscar"/>
                </form>

                <a href="#" class="nav_icon">
                    <img src="../../../images/icons/user.png" alt="account logo"/>
                    <span>Cuenta</span>
                </a>
                <a href="#" class="nav_icon">
                    <img src="../../../images/icons/mail.png" alt="feedback logo"/>
                    <span>Feedback</span>
                </a>
                <a href="../../../config/close_session.php" class="nav_icon">
                    <img src="../../../images/icons/team.png" alt="about logo"/>
                    <span>About</span>
                </a>

            </div>

            <nav id="header_nav">
                <a class="nav_a" href="index.php?codigo=<?php echo $usu_id; ?>">Inicio</a>
                <a class="nav_a" href="users.php?codigo=<?php echo $usu_id; ?>">Registrar Usuarios</a>
                <a class="nav_a" href="show_users.php?codigo=<?php echo $usu_id; ?>">Listar Usuarios</a>
                <a class="nav_a" href="manage_users.php?usu_id=-1&codigo=<?php echo $usu_id; ?>">Administrar usuarios</a>
                <a class="nav_a" href="#">Pendiente 5</a>
                <a class="nav_a" href="#">Pendiente 6</a>
                <a class="nav_a" href="#">Pendiente 7</a>
            </nav>
            
        </header>
        <!-- Fin Barra Nav   -->

        <section class="form_section">
            <header>
                <h2>Visualizar/Filtrar Usuarios - Activos</h2>
            </header>
            
            <form id="f_filter_data" name="f_filter_data" class="form_data" method="POST">
                <input type="hidden" name="admin_code" id="admin_code" value="<?php echo $usu_id; ?>"></input>
                
                <label for="i_filter" class="l_i_text">Filtrar:</label>
                <input type="text" name="i_filter" id="i_filter" class="text_input" onkeyup="filterUsers(0)"/>
                <br>
                <span id="s_filter_notice" class="s_error_validation"></span>
            </form>


            <div id="users_list" class="table_container">
                <script>
                    listUser(0);
                </script>
                <table id="user_data" class="table_numbers">
                    
                </table>
		    </div>

        </section>

        <!-- <footer id="pie">
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
        </footer> -->
    </body>
</html>