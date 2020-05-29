<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
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
	<title>Administración de mis Teléfonos</title>
</head>
<body>
    <?php
        $tel_codigo = $_GET["tel_codigo"];
		$usu_id = $_GET["usu_codigo"];

	?>
    <header id="main_header">
            
        <div id="logo_container">

            <a href="index.php?codigo=<?php echo $usu_id?>" id="img_logo">
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
                <span>About</span>
            </a>

        </div>

		<nav id="header_nav">
			<a class="nav_a" href="index.php?codigo=<?php echo $usu_id; ?>">Inicio</a>
			<a class="nav_a" href="#">Buscar</a>
			<a class="nav_a" href="phones.php?codigo=<?php echo $usu_id; ?>">Mis Teléfonos</a>
			<a class="nav_a" href="manage_phones.php?tel_codigo=-1&usu_codigo=<?php echo $usu_id; ?>">Gestionar mis Teléfonos</a>
        </nav>
        
    </header>
    <!-- Fin Barra Nav   -->
	<h1 class="main_title">Administración de mis Teléfonos</h1>
	<main class="main_container">
		<section class="col col-30">
			<div id="notice" class="div_notice e_hidden"></div>
			<?php
					
					$sql = "SELECT * FROM usuarios where usu_codigo=$usu_id";

					include '../../../config/conexionBD.php';
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {
			?>
			<form id="f_personal_data" class="form_data">
				<input type="hidden" name="i_user_id" id="i_user_id" value="<?php echo $usu_id; ?>"/>

				<label for="i_name" class="l_i_text">Usuario:</label>
				<input type="text" name="i_name" id="i_name" class="text_input" disabled value="<?php echo $row["usu_nombre"] . " " . $row["usu_apellido"]; ?>"/>
				<br>
				
				<label for="i_email" class="l_i_text">Correo:</label>
				<input type="text" name="i_email" id="i_email" class="text_input" disabled value="<?php echo $row["usu_correo"]; ?>"/>
			</form>

			<script>
					var phoneId  = <?php echo $tel_codigo?>;
					if(phoneId != '-1'){
						readPhone("f_phone", phoneId);
					}

			</script>
			<form id="f_phone" name="f_phone" class="form_data e_hidden" method="POST">
				
				
			</form>
		</section>
		<div id="phone_list" class="col col-70 table_container">
			<form id="f_search_phone" name="f_search_phone" class="form_data col-70 form_transparent" method="POST">
				<input type="search" name="i_search_phone" id="i_search_phone" class="text_input" 
					placeholder="Buscar para gestionar"
					onkeyup="filterPhone(this.value, 1)"/>
			</form>
			<?php 
							}	
					}else{
						echo "<p> No se encuentra al usuario.</p>";
						echo "<p>" . mysqli_error($conn) . "</p>";
					} ?>
			<script>
				listPhones(<?php echo $usu_id?>, '1');
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
