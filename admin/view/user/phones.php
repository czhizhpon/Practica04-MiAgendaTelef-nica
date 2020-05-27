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
	<script src="../../../js/phone_validation.js"></script>
	<title>Mis Teléfonos</title>
</head>
<body>
	<?php
		$usu_id = $_GET["codigo"];
	?>
    <header id="main_header">
            
        <div id="logo_container">

            <a href="index.php?codigo=<?php echo $usu_id?>" id="img_logo">
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
            <a class="nav_a" href="index.php?codigo=<?php echo $usu_id?>">Inicio</a>
            <a class="nav_a" href="phones.php?codigo=<?php echo $usu_id; ?>">Mis Teléfonos</a>
            <a class="nav_a" href="manage_phones.php?tel_codigo=-1&usu_codigo=<?php echo $usu_id; ?>">Administrar Mis Teléfonos</a>
            <a class="nav_a" href="#">Pendiente 3</a>
            <a class="nav_a" href="#">Pendiente 4</a>
            <a class="nav_a" href="#">Pendiente 5</a>
            <a class="nav_a" href="#">Pendiente 6</a>
            <a class="nav_a" href="#">Pendiente 7</a>
        </nav>
        
    </header>
    <!-- Fin Barra Nav   -->

	<section class="form_section">
		<header>
			<h2>Mis Teléfonos</h2>
		</header>
		<div id="notice" class="e_notice e_hidden"></div>
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
		<form id="f_search_phone" name="f_search_phone" class="form_data" action="" method="POST">
			<input type="search" name="i_search_phone" id="i_search_phone" class="text_input" 
				placeholder="Buscar en mis Números"
				onkeyup="filterPhone(this.value, 0)"/>
		</form>
		<?php 
						}	
				}else{
					echo "<p> No se encuentra al usuario.</p>";
					echo "<p>" . mysqli_error($conn) . "</p>";
				} ?>				
		
		<div id="phone_list" class="table_container">
			<script>
				listPhones(<?php echo $usu_id?>, 0);
			</script>
			<table id="user_numbers" class="table_numbers">
				
			</table>
		</div>
	</section>
</body>
</html>
