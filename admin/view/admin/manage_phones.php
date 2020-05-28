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
	<script src="../../../js/phone_validation.js"></script>
	<script src="../../../js/crud_phones_admin.js"></script>
	<title>Administración de Teléfonos</title>
</head>
<body>
    <?php
        // $tel_codigo = $_GET["tel_codigo"];
		// $usu_codigo = $_GET["usu_codigo"];

	?>
    <header id="main_header">
            
        <div id="logo_container">

            <a href="index.php?codigo=<?php echo $usu_codigo?>" id="img_logo">
                <img src="../../images/icons/logo.png" alt="Logo Game Specs"/>
            </a>

            <form id="f_search">  
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
            <a href="../../../config/close_session.php" class="nav_icon">
                <img src="../../images/icons/team.png" alt="about logo"/>
                <span>About</span>
            </a>

        </div>

        <nav id="header_nav">
            <a class="nav_a" href="index.php">Inicio</a>
            <!-- <a class="nav_a" href="phones.php">Mis Teléfonos</a> -->
            <a class="nav_a" href="manage_phones.php">Administración de Teléfonos</a>
            <a class="nav_a" href="#">Registrar Teléfonos</a>
            <a class="nav_a" href="#">Pendiente 4</a>
            <a class="nav_a" href="#">Pendiente 5</a>
            <a class="nav_a" href="#">Pendiente 6</a>
            <a class="nav_a" href="#">Pendiente 7</a>
        </nav>
        
    </header>
    <!-- Fin Barra Nav   -->

	<section class="form_section">
		<header>
			<h2>Administración de Teléfonos</h2>
		</header>
		<div id="notice" class="e_notice e_hidden"></div>
		<form id="f_phone" name="f_phone" class="form_data e_hidden" method="POST">
            
			
		</form>
		<form id="f_search_phone" name="f_search_phone" class="form_data" action="" method="POST">
			<input type="search" name="i_search_phone" id="i_search_phone" class="text_input" 
				placeholder="Buscar para administrar"
				onkeyup="listAdminPhones(this.value)"/>
		</form>				
		<div id="phone_list" class="table_container">
			<script>
				listAdminPhones("");
			</script>
			<table id="user_numbers" class="table_numbers">
				
			</table>
		</div>
	</section>
</body>
</html>
