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
    <link href="../../../css/create_user_layout.css" rel="stylesheet"/>
    <link href="../../../css/main_format.css" rel="stylesheet"/>
	<title>Crear Usuario</title>
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
			<?php
					
					$sql = "SELECT * FROM usuarios where usu_codigo=$usu_id";

					include '../../../config/conexionBD.php';
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {
			?>
			<form id="f_personal_data">
				<input type="hidden" name="i_user_id" id="i_user_id" disabled value="<?php $usu_id; ?>"/>
				<label for="i_name">Usuario:</label>
				<input type="text" name="i_name" id="i_name" class="text_input" disabled value="<?php echo $row["usu_nombre"] . " " . $row["usu_apellido"]; ?>"/>
				<br>
				
				<label for="i_email">Correo:</label>
				<input type="text" name="i_email" id="i_email" class="text_input" disabled value="<?php echo $row["usu_correo"]; ?>"/>

			</form>
					<?php 
						}	
				}else{
					echo "<p> No se encuentra al usuario.</p>";
					echo "<p>" . mysqli_error($conn) . "</p>";
				} ?>				
		<div id="phone_list" class="table_container">
			<table id="user_numbers" class="table_numbers">
				<tr>
					<th>Número</th>
					<th>Tipo</th>
					<th>Operadora</th>

				</tr>
				<?php
					$sqlPhones = "SELECT * FROM telefonos where usu_codigo=$usu_id and tel_eliminado = 'N'";

					$resultPh = $conn->query($sqlPhones);
					if ($resultPh -> num_rows > 0) {

						while($rowPh = $resultPh -> fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $rowPh['tel_numero'] . "</td>";
							echo "<td>" . $rowPh['tel_tipo'] . "</td>";
							echo "<td>" . $rowPh['tel_operadora'] . "</td>";
							echo "<td> <a href='delete_phone.php?codigo=" . $rowPh['tel_codigo'] . "'>Eliminar</a></td>";
							echo "<td> <a href='update_phone.php?codigo=" . $rowPh['tel_codigo'] . "'>Modificar</a></td>";
							echo "</tr>";
						}
					} else {
						echo "<tr>";
						echo " <td colspan='2'> No existen teléfonos para este usuario.</td>";
						echo "</tr>";
					}
					
				$conn->close();
				?>
			</table>
		</div>
	</section>
</body>
</html>
