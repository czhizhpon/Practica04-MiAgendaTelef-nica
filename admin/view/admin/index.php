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

        <!--
        Practica04-Mi Agenda Telefónica
        Index para usuarios públicos o anónimos
        Authors: Bryan Sarmiento, Eduardo Zhizhpon
        Date: 22/05/2020

        Filename: index.html
        -->

        <meta charset="utf-8" />
        <meta name="keywords" content="game, pc, specs, gameplays"/>
        <link rel="shortcut icon" href="../../images/icons/logo.png">

        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
		<link href="../../../css/main_format.css" rel="stylesheet">
        <link href="../../../css/index_layout.css" rel="stylesheet">

        <title>Agenda Telefónica</title>

    </head>
    <body>
        <?php 

            $usu_id = $_GET["codigo"];
            include '../../../config/conexionBD.php';
        
        ?>

        <header id="main_header">
            
            <div id="logo_container">

                <a href="index.php?codigo=<?php echo $usu_id; ?>" id="img_logo">
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
                <a class="nav_a" href="users.php?codigo=<?php echo $usu_id; ?>">Registrar Usuarios</a>
                <a class="nav_a" href="show_users.php?codigo=<?php echo $usu_id; ?>">Listar Usuarios</a>
                <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1&codigo=<?php echo $usu_id; ?>">Administrar usuarios</a>
                <a class="nav_a" href="#">Pendiente 4</a>
                <a class="nav_a" href="#">Pendiente 5</a>
                <a class="nav_a" href="#">Pendiente 6</a>
                <a class="nav_a" href="#">Pendiente 7</a>
            </nav>
            
        </header>
        <!-- Fin Barra Nav-->


        <main id="main">

            <section id="section_welcome">

                <div id="welcome_text">
                    <header>
                        <h2>Bienvenidos a Agendas Nuvarmi S.A.</h2>
                    </header>
                    
                    <p>
                        Inicia Pendiente.
                    </p>
                   
                    <button type="button" class="index_button" onclick="location.href='create_user.html'"> Iniciar Sesión </button>
                    <button type="button" class="index_button" onclick="location.href='create_user.html'">Registrarse</button>
                    
                    
                </div>
                
                <img src="../../images/icons/info.png" alt="index main image"/>

            </section>

            <!--
                Geleria de Noticas
            -->
            <section id="contacts">
                <header>
                    <h2>Contactos Recientes</h2>
                </header>
                <div id="contacts_content">
                    <article>
                        <a href="site/general/news.html">
                            <img src="images/news/news_eye_tracking.jpg" alt="new 1 picture">
                            <h3>Solución de seguimiento ocular</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="images/news/news_vr_homemade.jpg" alt="new 1 picture">
                            <h3>Headset VR hecho en casa con un Raspberry Pi</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="images/news/vr_ces_2020.jpg" alt="new 1 picture">
                            <h3>Lo mejor de la realidad virtual en CES 2020</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="images/news/news_nin_switch_april_2020.jpg" alt="new 1 picture">
                            <h3>11 nuevos y emocionantes juegos llegarán a Nintendo Switch en abril</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="images/news/news_nvidia.jpg" alt="new 1 picture">
                            <h3>Nvidia Gaming Platform: Nvidia lanzará nuevos juegos todos los jueves</h3>
                        </a>
                    </article>

                    <article>
                        <a href="site/general/news.html">
                            <img src="images/news/news_bill_depresion.jpg" alt="new 1 picture">
                            <h3>Con los niños fuera de la escuela y jugando en línea, los padres enfrentan facturas de choque</h3>
                        </a>
                    </article>

                </div>
                <button type="button" class="index_button"> Ver más </button>
                
            </section>

            <!-- Fin Galeria de Noticias-->

            <section id="reviews">
                <header>
                    <h2>Opiniones:</h2>
                </header>

                <div id="reviews_content">
                    <blockquote>
                        <div class="stars">
                            <img src="images/index/users/user_1.png" alt="user picture"/>
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
                            <img src="images/index/users/user_1.png" alt="user picture"/>
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
                            <img src="images/index/users/user_1.png" alt="user picture"/>
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
						<img src="images/index/users/user_1.png" alt="User team picture"/>

						<h3>Bryan Sarmiento</h3>

					</aside>

					<aside>
						<img src="images/index/users/user_1.png" alt="User team picture"/>

						<h3>Eduardo Zhizhpon</h3>

					</aside>

				</div>
			</section>
		</main>
        <footer id="pie">
            <div class="cont_pie">
                <div id="logo_pie">
                    <a href="https://www.facebook.com/" target="_blank"><img src="../../images/icons/faceLogo.png" alt="Facebook Logo"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="../../images/icons/instaLogo.png" alt="Instagram Logo"></a>
                </div>
                <img src="images/logoSO.png" alt="">

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