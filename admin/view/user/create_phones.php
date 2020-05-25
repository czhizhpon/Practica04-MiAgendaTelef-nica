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
    <!-- <link href="../../../css/create_user_layout.css" rel="stylesheet"/> -->
    <link href="../../../css/main_format.css" rel="stylesheet"/>
    <script src="../../../js/phone_validation.js"></script>
	<title>Crear Teléfono</title>
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
			<h2>Crear Teléfono</h2>
		</header>
		<form id="f_personal_data" onsubmit="return submitForm()" 
		action="../controller/create_user.php"
        method="POST">
            <input type="hidden" name="i_user" id="i_user" value="">
			<label for="i_phone_number">Número:</label>
			<input type="text" name="i_phone_number" id="i_phone_number" class="text_input i_phone" 
			placeholder="Número"
			onkeypress="return nNumberValidate(event, 10)" 
			onkeyup="return phoneValidate(this, 10)" 
            onblur="phoneError(this, 10)"/>
            <br/>

            <input type="radio" id="r_co" name="tel_type" value="CO">
            <label for="r_co">Convencional</label><br>
            <input type="radio" id="r_ce" name="tel_type" value="CE">
            <label for="r_ce">Celular</label><br>

            <label for="s_company">Operadora:</label>
            <select name="s_company" id="s_company">
                <option value="MOVISTAR">Movistar</option>
                <option value="TUENTI">Tuenti</option>
                <option value="CLARO">Claro</option>
                <option value="ETAPA">Etapa</option>
                <option value="CNT">CNT</option>
                <option value="OTROS">Otros</option>
            </select>
            
			<div class="d_button_container">
				<input type="submit" id="i_send_data" class="submit_input" value="Enviar"/>
			</div>
		</form>
	</section>
</body>
</html>
