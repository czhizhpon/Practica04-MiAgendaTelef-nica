<?php
    session_start();

    $usu_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === TRUE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<link rel="shortcut icon" href="../../images/icons/logo.png">
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../../../css/form_layout.css" rel="stylesheet"/>
    <link href="../../../css/main_format.css" rel="stylesheet"/>
	<link href="../../../css/2_col_layout.css" rel="stylesheet"/>
	<link href="../../../css/table_layout.css" rel="stylesheet"/>
	<script src="../../../js/phone_validation.js"></script>
	<script src="../../../js/resources.js"></script>
	<title>Mis Teléfonos</title>
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
            <a class="nav_a" href="phones.php">Mis Teléfonos</a>
            <a class="nav_a" href="manage_phones.php?tel_codigo=-1">Gestionar mis Teléfonos</a>
        </nav>
        
    </header>
	<!-- Fin Barra Nav   -->
	<h1 class="main_title">Mis Teléfonos</h1>
	<main class="main_container">
		<section class="col col-30">
			<div id="main_notice" class="e_hidden">	
				<div id="notice" class="div_notice"></div>
				<img src="../../../images/icons/close.png" class="close_x" onclick="hideNotice()">
			</div>
			<?php
					
					$sql = "SELECT * FROM usuarios where usu_codigo=$usu_id";

					include '../../../config/conexionBD.php';
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {
			?>
			<form id="f_personal_data" class="form_data">
				<label for="i_name" class="l_i_text">Usuario:</label>
				<input type="text" name="i_name" id="i_name" class="text_input" disabled value="<?php echo $row["usu_nombre"] . " " . $row["usu_apellido"]; ?>"/>
				<br>
				
				<label for="i_email" class="l_i_text">Correo:</label>
				<input type="text" name="i_email" id="i_email" class="text_input" disabled value="<?php echo $row["usu_correo"]; ?>"/>
			</form>

			<form id="f_phone" name="f_phone" class="form_data" onsubmit="return submitForm(event)" method="POST">
				<!-- action="../../controller/user/create_phones.php" -->
				

				<input type="hidden" name="i_user_codigo" id="i_user_id" value="<?php echo $usu_id; ?>"/>
				
				<label for="i_phone_number" class="l_i_text" >Número:</label>
				<input type="text" name="i_phone_number" id="i_phone_number" class="text_input" 
					placeholder="Número"
					onkeypress="return nNumberValidate(event, 10)" 
					onkeyup="return phoneValidate(this, 10)" 
					onblur="phoneError(this, 10)"/>
				
				<br/>
				
				<label class="l_i_text l_r_text">Tipo:</label>
				<div id="type_phone_container" class="i_r_container">
					<input type="radio" id="r_co" name="tel_type" value="CO" class="i_radio"
						onclick="typePhoneError()">
					<label for="r_co" class="l_radio" name="tel_type_label">Convencional</label><br>
					<input type="radio" id="r_ce" name="tel_type" value="CE" class="i_radio"
						onclick="typePhoneError()">
					<label for="r_ce" class="l_radio" name="tel_type_label">Celular</label><br>
				</div>

				<label for="s_company" class="l_i_text">Operadora:</label>
				<select name="s_company" id="s_company" class="text_input sel_form" onclick="companyPhoneError()">
					<option value="NaN">Seleccione...</option>
					<option value="MOVISTAR">Movistar</option>
					<option value="TUENTI">Tuenti</option>
					<option value="CLARO">Claro</option>
					<option value="ETAPA">Etapa</option>
					<option value="CNT">CNT</option>
					<option value="OTROS">Otros</option>
				</select>
				<br>
				<span id="s_phone_notice" class="s_error_validation e_hidden"></span>
				<br>
				<div class="d_button_container">
					<input type="submit" id="i_send_phone" class="submit_input" value="Agregar"/>
				</div>
			</form>
			
		</section>
		<?php 
							}	
					}else{
						echo "<p> No se encuentra al usuario.</p>";
						echo "<p>" . mysqli_error($conn) . "</p>";
					} ?>				
		
		<div class="col col-70">
			<form id="f_search_phone" name="f_search_phone" class="form_data col-70 form_transparent" method="POST">
				<input type="search" name="i_search_phone" id="i_search_phone" class="text_input search_input" 
					placeholder="Buscar en mis Números"
					onkeyup="filterPhone(this.value, 0)"/>
			</form>
			<div id="phone_list" class="table_container">
				<script>
					filterPhone("", 0);
				</script>
				<table id="user_numbers" class="table_content">
				
				</table>
			</div>
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
				<legend>Gestionar mi Cuenta</legend>
				<nav>
				<a class="nav_a" href="my_account.php">Mi Cuenta</a>
				<a class="nav_a" href="../../../config/close_session.php"> Cerrar Sesión</a>
				</nav>
			</fieldset>
		</div>

		<div class="cont_pie">
			<fieldset>
				<legend>Gestión de Teléfonos</legend>
				<nav>
					<a class="nav_a" href="phones.php">Mis Teléfonos</a>
					<a class="nav_a" href="manage_phones.php?tel_codigo=-1">Gestionar mis Teléfonos</a>
				</nav>
			</fieldset>
		</div>
	</footer>
</body>
</html>
