<?php
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <!--
            Practica04-Mi Agenda Telefónica
            Index para administradores
            Authors: Bryan Sarmiento, Eduardo Zhizhpon
            Date: 22/05/2020

            Filename: index.php
        -->

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="keywords" content="phonebook, users, calls, emails"/>

        <link rel="shortcut icon" href="../../../images/icons/logo.png"/>
        
		<link href="../../../css/main_format.css" rel="stylesheet"/>
        <link href="../../../css/index_layout.css" rel="stylesheet"/>

        <title>Agenda Telefónica</title>
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
                <a class="nav_a" href="users.php">Registrar Usuarios</a>
                <a class="nav_a" href="show_users.php">Listar Usuarios</a>
                <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1">Administrar Usuarios</a>
                <a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
                <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
            </nav>
        </header>
        
        <main id="main">
            <section id="section_welcome">
                <div id="welcome_text">
                    <?php 
                        include '../../../config/conexionBD.php';
                        
                        $sqlUser = "SELECT * FROM usuarios WHERE usu_codigo LIKE '$admin_id'";
                        $resultUser = $conn->query($sqlUser);
                        $row = $resultUser->fetch_assoc();
                        $names = $row['usu_nombre'];
                        $lastnames = $row['usu_apellido'];

                        $conn->close();
                    ?>
                    <header>
                        <h2>Bienvenido: <?php echo $lastnames .", ". $names ?> a Agendas Nuvarmi S.A.</h2>
                    </header>
                    
                    <p>
                        Puede comenzar registrando datos en el sistema.
                    </p>
                   
                    <button type="button" class="index_button btn_passive" onclick="location.href='users.php'">Registrar Usuario</button>
                    <button type="button" class="index_button btn_passive" onclick="location.href='create_phone.php'">Registrar Teléfono</button>
                </div>
                
                <img src="../../../images/icons/info.png" alt="index main image"/>
            </section>

            <section id="contacts">
                <header>
                    <h2>Contactos Recientes</h2>
                </header>
                <div id="contacts_content">
                    <article>
                        <a href="site/general/news.html">
                            <img src="../../../images/icons/logo.png" alt="new 1 picture">
                            <h3>Solución de seguimiento ocular</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="../../../images/icons/logo.png" alt="new 1 picture">
                            <h3>Headset VR hecho en casa con un Raspberry Pi</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="../../../images/icons/logo.png" alt="new 1 picture">
                            <h3>Lo mejor de la realidad virtual en CES 2020</h3>
                        </a>
                    </article>

                </div>
                <button type="button" class="index_button"> Ver más </button>
                
            </section>

            <section id="reviews">
                <header>
                    <h2>Opiniones:</h2>
                </header>

                <div id="reviews_content">
                    <blockquote>
                        <div class="stars">
                            <img src="../../../images/icons/logo.png" alt="user picture"/>
                            <br/>
                            <span class="s_o">★</span>
                            <span class="s_o">★</span>
                            <span class="s_g">★</span>
                            <span class="s_g">★</span>
                            <span class="s_g">★</span>
                        </div>

                        <p>
                            Making this film was one of the most exhausting but rewarding experiences 
                            I’ve ever had. We set out to make the most insane, intense action film and 
                            I’m beyond proud of what we’ve achieved. Thankful to everyone involved in
                             making this film possible. It’s out tomorrow on @netflix!
                        </p>
                    </blockquote>

                    <blockquote>
                        <div class="stars">
                            <img src="../../../images/icons/logo.png" alt="user picture"/>
                            <br/>
                            <span class="s_o">★</span>
                            <span class="s_o">★</span>
                            <span class="s_g">★</span>
                            <span class="s_g">★</span>
                            <span class="s_g">★</span>
                        </div>

                        <p>
                            Según Chris Hemsworth el guión de Thor Love And Thunder es de los 
                            mejores que ha leído en años
                        </p>
                    </blockquote>

                    <blockquote>
                        <div class="stars">
                            <img src="../../../images/icons/logo.png" alt="user picture"/>
                            <br/>
                            <span class="s_o">★</span>
                            <span class="s_o">★</span>
                            <span class="s_g">★</span>
                            <span class="s_g">★</span>
                            <span class="s_g">★</span>
                        </div>

                        <p>
                            Great news. Mantis & Gef the Ravager themselves - @PomKlementieff & @steveagee - 
                            will be joining us tonight for the #GotGVol2 #QuarantineWatchParty. Please bombard 
                            them with questions. Also maybe @seangunn will join if his lazy ass texts me back.
                        </p>
                    </blockquote>
                </div>

            </section>
        
			<section id="team">
				<header>
					<h2>El Equipo</h2>
				</header>
				<div id="team_content">
					<aside>
						<img src="../../../images/icons/logo.png" alt="User team picture"/>

						<h3>Bryan Sarmiento</h3>

					</aside>

					<aside>
						<img src="../../../images/icons/logo.png" alt="User team picture"/>

						<h3>Eduardo Zhizhpon</h3>

					</aside>

				</div>
            </section>
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
                    <legend>Gestión de Usuarios</legend>
                    <nav>
                    <a class="nav_a" href="users.php">Registrar Usuarios</a>
                    <a class="nav_a" href="show_users.php">Listar Usuarios</a>
                    <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1">Administrar usuarios</a>
                    </nav>
                </fieldset>
            </div>

            <div class="cont_pie">
                <fieldset>
                    <legend>Gestión de Teléfonos</legend>
                    <nav>
                        <a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
                        <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
                    </nav>
                </fieldset>
            </div>
        </footer>
    </body>
</html>