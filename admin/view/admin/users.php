<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../../../css/form_layout.css" rel="stylesheet"/>
    <link href="../../../css/main_format.css" rel="stylesheet"/>
	<script src="../../../js/create_user_validation.js"></script>
	<title>Crear Usuario - Admin</title>
</head>
<body>
    <header id="main_header">
            
        <div id="logo_container">

            <a href="index.html" id="img_logo">
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
            <a href="#" class="nav_icon">
                <img src="../../../images/icons/team.png" alt="about logo"/>
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

	<section class="form_section">
		<header>
			<h2>Crear Usuario</h2>
		</header>
		<form id="f_personal_data" onsubmit="return submitForm(event)" 
		action="../../controller/admin/create_user.php"
		method="POST">
            
            <label for="i_dni">Cédula:</label>
			<input type="text" name="i_dni" id="i_dni" class="text_input" 
				onkeypress="return nNumberValidate(event, 10)" 
				onkeyup="dniFormatValidation(this)" 
				onblur="dniError(this)"/>
			<!--<br>-->
			<span id="s_dni_notice" class="s_error_validation"></span>
            
            <!--<br>-->
			
			<label for="i_name">Nombres:</label>
			<input type="text" name="i_name" id="i_name" class="text_input" 
			onkeypress="return onlyTextInput(event)" 
			onkeyup="nStringValidate(this, 2, 's_name_notice')" 
			onblur="nameError(this, 2)"/>
			<!--<br>-->
			<span id="s_name_notice" class="s_error_validation"></span>
            
            <!--<br>-->
			
			<label for="i_lastname">Apellidos:</label>
			<input type="text" name="i_lastname" id="i_lastname" class="text_input" 
			onkeypress="return onlyTextInput(event)" 
			onkeyup="nStringValidate(this, 2, 's_lastname_notice')" 
			onblur="lastnameError(this, 2)"/>
            <!--<br>-->
			<span div id="s_lastname_notice" class="s_error_validation"></span>
            
            <!--<br>-->
			
			<label for="i_address">Dirección:</label>
			<input type="text" name="i_address" id="i_address" class="text_input" 
			onkeyup="addressEmptyValidation(this)" onblur="addressError(this)"/>
            <!--<br>-->
			<span id="s_address_notice" class="s_error_validation"></span>
            
            <!--<br>-->
			
			<label for="i_born">F. Nacimiento:</label>
			<input type="date" name="i_born" id="i_born" class="text_input"
			onkeyup="dateFormatValidation(this)" onblur="dateError(this)"/>
			<!--<br>-->
			<span id="s_born_notice" class="s_error_validation"></span>
            
            <!--<br>-->
			
			<label for="i_email">Email:</label>
			<input type="text" name="i_email" id="i_email" class="text_input" 
			onkeyup="emailFormatValidation(this)" onblur="emailError(this)"/>
			<!--<br>-->
            <span id="s_email_notice" class="s_error_validation"></span>
                
            <!--<br>-->
            
            <label class="l_i_text l_r_text">Tipo de Usuario:</label>
            <div id="type_user_container" class="i_r_container">
                <input type="radio" id="r_u" name="usu_type" value="U" class="i_radio"
                    onclick="typeUserError()">
                <label for="r_u" class="l_radio" name="usu_type_label">Usuario</label>
                <br>

                <input type="radio" id="r_a" name="usu_type" value="A" class="i_radio"
                    onclick="typeUserError()">
                <label for="r_a" class="l_radio" name="usu_type_label">Administrador</label>
                <br>
            </div>

            <!--<br>-->
			
			<label for="i_password">Contraseña:</label>
			<input type="password" name="i_password" id="i_password" class="text_input" 
			onkeyup="return passwordFormatValidation(this)" 
			onblur="passwordError(this)"/>
			<!--<br>-->
			<span id="s_password_notice" class="s_error_validation"></span>
			
			<!--<br>-->
			
			<div class="d_button_container">
				<input type="submit" id="i_send_data" class="submit_input" value="Enviar"/>
			</div>
		</form>
	</section>
</body>
</html>