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
	<title>Registrar Teléfonos</title>
</head>
<body>
	<?php
		// $usu_id = $_GET["codigo"];
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
            <a class="nav_a" href="manage_phones.php">Administración de Teléfonos</a>
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
			<h2>Registrar Teléfonos</h2>
		</header>
		<div id="notice" class="e_notice e_hidden"></div>

		<form id="f_phone" name="f_phone" class="form_data" method="POST">
			
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
            
            <label class='l_i_text l_r_text' >Eliminado:</label>
            <div id='eliminated_phone_container' class='i_c_container'>
                <input type='checkbox' class='i_check' name='i_check_tel_eliminado' value='E' />
            </div>
            <label for='i_user_dni' class='l_i_text' >CI. Usuario:</label>
            <input type='text' name='i_user_dni' id='i_user_dni' class='text_input' 
				placeholder='Ingrese CI.'
				onkeyup='dniPhoneValidation(this)'
				onblur='dniPhoneError(this)'>
            
			<span id="s_phone_notice" class="s_error_validation e_hidden"></span>
			<br>
			<div class="d_button_container">
				<input type="button" id="i_send_phone" class="submit_input" value="Agregar" onclick="submitAdminForm()"/>
			</div>
		</form>
	</section>
</body>
</html>
