<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../../css/create_user_layout.css" rel="stylesheet"/>
    <link href="../../css/main_format.css" rel="stylesheet"/>
	<script src="../../js/create_phone_validation.js"></script>
	<title>Crear Usuario</title>
</head>
<body>
    <header id="main_header">
            
        <div id="logo_container">

            <a href="index.html" id="img_logo">
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
            <a href="#" class="nav_icon">
                <img src="../../images/icons/team.png" alt="about logo"/>
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
		action="../controller/create_user.php"
        method="POST">
        
			<label for="i_phone_number">Teléfono y Operadora:</label>
			<input type="text" name="i_phone_number" id="i_phone_number" class="text_input i_phone" 
			placeholder="Número"
			onkeypress="return nNumberValidate(event, 10)" 
			onkeyup="return phoneValidate(this, 10)" 
			onblur="phoneError(this, 10)"/>

			<input type="text" name="i_phone_company" id="i_phone_company" class="text_input i_phone"
			placeholder="Companía"
			onkeyup="phoneCompanyEmptyValidation(this)"
			onblur="phoneCompanyError(this)"/>

			<input type="hidden" name="i_phones" id="i_phones" value="">
			<input type="hidden" name="i_companies" id="i_companies" value="">

			<input type="button" id="btn_add_tel" value="+"
			onclick="addPhone()">
            <br>
			<span id="s_phone_notice" class="s_error_validation"></span>
			<br>

			<div id="phone_list" class="table_container" onclick="delPhone(event)">
				<table id="user_numbers" class="table_numbers">
					<tr>
						<th>Número</th>
						<th>Operadora</th>
						<th>Eliminar</th>
					</tr>
					<tr>
						<?php
							
						?>
					</tr>
				</table>
			</div>

			<div class="d_button_container">
				<input type="submit" id="i_send_data" class="submit_input" value="Enviar"/>
			</div>
		</form>
	</section>
</body>
</html>
