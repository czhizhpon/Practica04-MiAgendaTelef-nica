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
        $tel_codigo = $_GET["tel_codigo"];
		$usu_codigo = $_GET["usu_codigo"];

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
            <a class="nav_a" href="index.php?codigo=<?php echo $usu_codigo?>">Inicio</a>
            <a class="nav_a" href="phones.php?codigo=<?php echo $usu_codigo; ?>">Mis Teléfonos</a>
            <a class="nav_a" href="#">Administrar Mis Teléfonos</a>
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
		<?php
				
				$sql = "SELECT * FROM usuarios where usu_codigo=$usu_codigo";

				include '../../../config/conexionBD.php';
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {

					while($row = $result->fetch_assoc()) {
		?>
		<form id="f_personal_data" class="form_data">
            <input type="hidden" name="i_user_id" id="i_user_id" value="<?php echo $usu_codigo; ?>"/>

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
		<form id="f_phone" name="f_phone" class="form_data" onsubmit="return updatePhone()" method="POST">
            
			
		</form>
		<form id="f_search_phone" name="f_search_phone" class="form_data" action="" method="POST">
			<input type="search" name="i_search_phone" id="i_search_phone" class="text_input" 
				placeholder="Buscar para administrar"
				onkeyup="filterPhone(this.value, 1)"/>
		</form>
		<?php 
						}	
				}else{
					echo "<p> No se encuentra al usuario.</p>";
					echo "<p>" . mysqli_error($conn) . "</p>";
				} ?>				
		
		<div id="phone_list" class="table_container">
			<script>
				listPhones(<?php echo $usu_codigo?>, '1');
			</script>
			<table id="user_numbers" class="table_numbers">
				
			</table>
		</div>
	</section>
</body>
</html>
