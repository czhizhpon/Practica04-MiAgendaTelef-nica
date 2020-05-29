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
    
	<script src="../../../js/phone_validation.js"></script>
	<script src="../../../js/crud_phones_admin.js"></script>
	<title>Administración de Teléfonos</title>
</head>
<body>
    <?php
        $usu_id = $_GET["codigo"];
        include '../../../config/conexionBD.php';

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
                <a class="nav_a" href="create_phone.php?codigo=<?php echo $usu_id; ?>">Registrar Teléfonos</a>
                <a class="nav_a" href="manage_phones.php?codigo=<?php echo $usu_id; ?>">Administrar Teléfonos</a>
        </nav>
        
    </header>
    <!-- Fin Barra Nav   -->
    <h1 class="main_title">Administración de Teléfonos</h1>
    <main class="main_container">
        <section class="col col-30">
            <form id="f_search_phone" name="f_search_phone" class="form_data col col-100 form_transparent" method="POST">
                <input type="search" name="i_search_phone" id="i_search_phone" class="text_input" 
                    placeholder="Buscar para administrar"
                    onkeyup="listAdminPhones(this.value)"/>
            </form>
            <div id="notice" class="div_notice e_hidden"></div>
            <form id="f_phone" name="f_phone" class="form_data e_hidden" method="POST">
            </form>
        </section>			
        <div id="phone_list" class="col col-70 table_container">
            <script>
                listAdminPhones("");
            </script>
            <table id="user_numbers" class="table_content">
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
                    <a class="nav_a" href="create_phone.php?codigo=<?php echo $usu_id; ?>">Registrar Teléfonos</a>
                    <a class="nav_a" href="manage_phones.php?codigo=<?php echo $usu_id; ?>">Administrar Teléfonos</a>
                </nav>
            </fieldset>
        </div>
    </footer>
</body>
</html>
