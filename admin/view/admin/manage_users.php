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
        <link href="../../../css/2_col_layout.css" rel="stylesheet"/>
        <link href="../../../css/table_layout.css" rel="stylesheet"/>

        <script src="../../../js/crud_users_admin.js"></script>
        <script src="../../../js/create_user_validation.js"></script>
        <title>Administrar Usuario - Admin</title>
    </head>

    <body>
        <?php
            $usu_id = $_GET["codigo"]; // Administrador logeado.
            $user_id = $_GET["usu_id"]; // Usuario al que se va a modificar
            $readAction = $_GET["readAction"];
        ?>

        <header id="main_header">
            
            <div id="logo_container">

                <a href="index.php?codigo=<?php echo $usu_id; ?>" id="img_logo">
                    <img src="../../../images/icons/logo.png" alt="Logo Game Specs"/>
                </a>

                <form id="f_search">  
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
                    <span>Cerrar Sesión</span>
                </a>

            </div>

            <nav id="header_nav">
                <a class="nav_a" href="index.php?codigo=<?php echo $usu_id; ?>">Inicio</a>
                <a class="nav_a" href="users.php?codigo=<?php echo $usu_id; ?>">Registrar Usuarios</a>
                <a class="nav_a" href="show_users.php?codigo=<?php echo $usu_id; ?>">Listar Usuarios</a>
                <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1&codigo=<?php echo $usu_id; ?>">Administrar Usuarios</a>
                <a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
                <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
            </nav>
            
        </header>
        <!-- Fin Barra Nav   -->

        <h1 class="main_title">Administración de Usuarios</h1>

        <main class="main_container">
            <section class="col col-30">

                <form id="f_filter_data" name="f_filter_data" class="col col-100 form_data form_transparent" method="POST">
                    <input type="hidden" name="admin_code" id="admin_code" value="<?php echo $usu_id; ?>"></input>
                    
                    <label for="i_filter" class="l_i_text">Filtrar:</label>
                    <input type="text" name="i_filter" id="i_filter" class="text_input" onkeyup="filterUsers(this.value, 1)" />
                    <br>
                    <span id="s_filter_notice" class="s_error_validation"></span>
                </form>
            
                <script>
                    var userID = <?php echo $user_id ?>;
                    var readAction = <?php echo $readAction ?>;
                    if (userID != '-1' && readAction != '-1') {
                        readUser("f_personal_data", userID, readAction);
                    }
                </script>

                <div id="notice" class="div_notice e_hidden">

                </div>

                <form id="f_personal_data" name="f_personal_data" class="e_hidden form_data" onsubmit="return submitFormAdmin(event, 2)"
                method="POST">
                    
                </form>

                <form id="f_password" name="f_password" class="e_hidden form_data" onsubmit="return submitFormPass(event, 1)"
                method="POST">
                    
                </form>
            </section>

            <div id="users_list" class="col col-70 table_container">
                <!--  <script>
                    listUser(<?php echo $usu_id?>);
                </script> -->
                <table id="user_data" class="table_content">
                    <tr>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Direccion</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                        <td colspan="8">Ingrese algun criterio de busqueda para obtener usuarios.</td>
                    </tr>
                    
                </table>
            </div>

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
                    <a class="nav_a" href="users.php?codigo=<?php echo $usu_id; ?>">Registrar Usuarios</a>
                    <a class="nav_a" href="show_users.php?codigo=<?php echo $usu_id; ?>">Listar Usuarios</a>
                    <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1&codigo=<?php echo $usu_id; ?>">Administrar usuarios</a>
                    </nav>
                </fieldset>
            </div>

            <div class="cont_pie">
                <fieldset>
                    <legend>Gestión de Teléfonos</legend>
                    <nav>
                        <a class="nav_a" href="create_phones.php">Registrar Teléfonos</a>
                        <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
                    </nav>
                </fieldset>
            </div>
        </footer>
    </body>
</html>