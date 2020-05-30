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
            Página para listar a todos los usuarios activos
            Authors: Bryan Sarmiento, Eduardo Zhizhpon
            Date: 27/05/2020

            Filename: show_users.php
        -->

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link rel="shortcut icon" href="../../../images/icons/logo.png"/>

        <link href="../../../css/form_layout.css" rel="stylesheet"/>
        <link href="../../../css/main_format.css" rel="stylesheet"/>
        <link href="../../../css/2_col_layout.css" rel="stylesheet"/>
        <link href="../../../css/table_layout.css" rel="stylesheet"/>

        <script src="../../../js/crud_users_admin.js"></script>
        <script src="../../../js/create_user_validation.js"></script>

        <title>Visualizar Usuarios - Admin</title>
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

        <h1 class="main_title">Visualizar/Filtrar Usuarios - Activos</h1>

        <main class="main_container center_container">
            <section class="col col-100 form_section">
                
                <form id="f_filter_data" name="f_filter_data" class="col col-100 form_data form_transparent" method="POST">
                    <input type="hidden" name="admin_code" id="admin_code" value="<?php echo $admin_id; ?>"></input>
                    
                    <input type="search" name="i_filter" id="i_filter" class="text_input" onkeyup="filterUsers(this.value, 0)" 
                        placeholder="Ingrese un parametro de filtrado"/>
                    <br>
                    <span id="s_filter_notice" class="s_error_validation"></span>
                </form>

                <div id="users_list" class="col col-100 table_container">
                    <script>
                        filterUsers("", 0);
                    </script>
                    <table id="user_data" class="table_content">
                    
                    </table>
                </div>
            
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
    </body>
</html>