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
        <link href="../../../css/2_col_layout.css" rel="stylesheet"/>

        <script src="../../../js/crud_users_admin.js"></script>
        <script src="../../../js/create_user_validation.js"></script>
        <title>Crear Usuario - Admin</title>
    </head>

    <body>
        <?php
            $usu_id = $_GET["codigo"];
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
                    <span>Cerrar Sesión</span>
                </a>

            </div>

            <nav id="header_nav">
                <a class="nav_a" href="index.php?codigo=<?php echo $usu_id; ?>">Inicio</a>
                <a class="nav_a" href="users.php?codigo=<?php echo $usu_id; ?>">Registrar Usuarios</a>
                <a class="nav_a" href="show_users.php?codigo=<?php echo $usu_id; ?>">Listar Usuarios</a>
                <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1&codigo=<?php echo $usu_id; ?>">Administrar Usuarios</a>
                <a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
                <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
            </nav>
            
        </header>
        <!-- Fin Barra Nav   -->

        <h1 class="main_title">Crear Usuario</h1>

        <main class="main_container center_container">
            <section class="col col-50">

                <div id="notice" class="div_notice e_hidden"></div>

                <form id="f_personal_data" name="f_personal_data" class="form_data" 
                    onsubmit="return submitFormAdmin(event, 1)" method="POST">
                    
                    <input type="hidden" name="admin_code" id="admin_code" value="<?php echo $usu_id; ?>"></input>
                    
                    <label for="i_dni" class="l_i_text">Cédula:</label>
                    <input type="text" name="i_dni" id="i_dni" class="text_input" 
                        onkeypress="return nNumberValidate(event, 10)" 
                        onkeyup="dniFormatValidation(this)" 
                        onblur="dniError(this)"/>
                    <br>
                    <span id="s_dni_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_name" class="l_i_text">Nombres:</label>
                    <input type="text" name="i_name" id="i_name" class="text_input" 
                    onkeypress="return onlyTextInput(event)" 
                    onkeyup="nStringValidate(this, 2, 's_name_notice')" 
                    onblur="nameError(this, 2)"/>
                    <br>
                    <span id="s_name_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_lastname" class="l_i_text">Apellidos:</label>
                    <input type="text" name="i_lastname" id="i_lastname" class="text_input" 
                    onkeypress="return onlyTextInput(event)" 
                    onkeyup="nStringValidate(this, 2, 's_lastname_notice')" 
                    onblur="lastnameError(this, 2)"/>
                    <br>
                    <span div id="s_lastname_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_address" class="l_i_text">Dirección:</label>
                    <input type="text" name="i_address" id="i_address" class="text_input" 
                    onkeyup="addressEmptyValidation(this)" onblur="addressError(this)"/>
                    <br>
                    <span id="s_address_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_born" class="l_i_text">F. Nacimiento:</label>
                    <input type="date" name="i_born" id="i_born" class="text_input"
                    onkeyup="dateFormatValidation(this)" onblur="dateError(this)"/>
                    <br>
                    <span id="s_born_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_email" class="l_i_text">Email:</label>
                    <input type="text" name="i_email" id="i_email" class="text_input" 
                    onkeyup="emailFormatValidation(this)" onblur="emailError(this)"/>
                    <br>
                    <span id="s_email_notice" class="s_error_validation"></span>
                        
                    <br>
                    
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
                    <span id="s_type_notice" class="s_error_validation"></span>

                    <br>
                    
                    <label for="i_password" class="l_i_text">Contraseña:</label>
                    <input type="password" name="i_password" id="i_password" class="text_input" 
                    onkeyup="return passwordFormatValidation(this)" 
                    onblur="passwordError(this)"/>
                    <br>
                    <span id="s_password_notice" class="s_error_validation"></span>

                    <div class="d_button_container">
                        <input type="submit" id="i_send_data" class="submit_input" value="Enviar"/>
                    </div>

                </form>

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
                    <a class="nav_a" href="users.php?codigo=<?php echo $usu_id; ?>">Registrar Usuarios</a>
                    <a class="nav_a" href="show_users.php?codigo=<?php echo $usu_id; ?>">Listar Usuarios</a>
                    <a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1&codigo=<?php echo $usu_id; ?>">Administrar usuarios</a>
                    </nav>
                </fieldset>
            </div>

            <div class="cont_pie">
                <fieldset>
                    <legend>Gestión de Teléfonos</legend>
                    <nav>
                        <a class="nav_a" href="create_phones.php">Registrar Teléfonos</a>
                        <a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
                    </nav>
                </fieldset>
            </div>
        </footer>
    </body>
</html>