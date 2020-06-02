<?php
    session_start();

    $usu_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === TRUE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <!--
            Practica04-Mi Agenda Telefónica
            Página para administrar los datos personales del administrador
            Authors: Bryan Sarmiento, Eduardo Zhizhpon
            Date: 30/05/2020

            Filename: manage_users.php
        -->

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link rel="shortcut icon" href="../../../images/icons/logo.png"/>

        <link href="../../../css/form_layout.css" rel="stylesheet"/>
        <link href="../../../css/main_format.css" rel="stylesheet"/>
        <link href="../../../css/2_col_layout.css" rel="stylesheet"/>

        <script src="../../../js/crud_user.js"></script>
        <script src="../../../js/create_user_validation.js"></script>
        <script src="../../../js/resources.js"></script>

        <title>Mi cuenta personal</title>
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
                <a class="nav_a" href="index.php">Inicio</a>
                <a class="nav_a" href="phones.php">Mis Teléfonos</a>
                <a class="nav_a" href="manage_phones.php?tel_codigo=-1">Gestionar mis Teléfonos</a>
            </nav>
        </header>

        <h1 class="main_title">Mis datos</h1>

        <?php 
            include '../../../config/conexionBD.php';
            
            $sqlUser = "SELECT * FROM usuarios WHERE usu_codigo LIKE '$user_id'";
            $resultUser = $conn->query($sqlUser);
            $row = $resultUser->fetch_assoc();

            $dni = $row['usu_cedula'];
            $names = $row['usu_nombre'];
            $lastnames = $row['usu_apellido'];
            $address = $row['usu_direccion'];
            $born = $row['usu_fecha_nacimiento'];
            $email = $row['usu_correo'];
            $type = $row['usu_rol'];
            $passMD5 = $row['usu_password'];

            $conn->close();
        ?>

        <div id="main_notice" class="e_hidden col-100 center_container">
            <div id="notice" class="div_notice col-40"></div>
            <img src="../../../images/icons/close.png" class="close_x" onclick="hideNotice()">
        </div>

        <main class="main_container">
            <section class="col col-50">
                <form id="f_personal_data" name="f_personal_data" class="form_data" 
                    onsubmit="return updateUser(event)" method="POST">

                    <input type="hidden" name="user_code" id="user_code" value="<?php echo $user_id ?>" />
                    <input type="hidden" name="usu_type" id="r_a" value="<?php echo $type ?>" />
                    
                    <label for="i_dni" class="l_i_text">Cédula:</label>
                    <input type="text" name="i_dni" id="i_dni" class="text_input" value="<?php echo $dni ?>"
                        onkeypress="return nNumberValidate(event, 10)" 
                        onkeyup="dniFormatValidation(this)" 
                        onblur="dniError(this)"/>
                    <br>
                    <span id="s_dni_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_name" class="l_i_text">Nombres:</label>
                    <input type="text" name="i_name" id="i_name" class="text_input" value="<?php echo $names ?>"
                    onkeypress="return onlyTextInput(event)" 
                    onkeyup="nStringValidate(this, 2, 's_name_notice')" 
                    onblur="nameError(this, 2)"/>
                    <br>
                    <span id="s_name_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_lastname" class="l_i_text">Apellidos:</label>
                    <input type="text" name="i_lastname" id="i_lastname" class="text_input" value="<?php echo $lastnames ?>"
                    onkeypress="return onlyTextInput(event)" 
                    onkeyup="nStringValidate(this, 2, 's_lastname_notice')" 
                    onblur="lastnameError(this, 2)"/>
                    <br>
                    <span div id="s_lastname_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_address" class="l_i_text">Dirección:</label>
                    <input type="text" name="i_address" id="i_address" class="text_input" value="<?php echo $address ?>"
                    onkeyup="addressEmptyValidation(this)" onblur="addressError(this)"/>
                    <br>
                    <span id="s_address_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_born" class="l_i_text">F. Nacimiento:</label>
                    <input type="date" name="i_born" id="i_born" class="text_input" value="<?php echo $born ?>"
                    onkeyup="dateFormatValidation(this)" onblur="dateError(this)"/>
                    <br>
                    <span id="s_born_notice" class="s_error_validation"></span>
                    
                    <br>
                    
                    <label for="i_email" class="l_i_text">Email:</label>
                    <input type="text" name="i_email" id="i_email" class="text_input" value="<?php echo $email ?>"
                    onkeyup="emailFormatValidation(this)" onblur="emailError(this)"/>
                    <br>
                    <span id="s_email_notice" class="s_error_validation"></span>

                    <br>

                    <div class="d_button_container">
                        <input type="button" id="i_delete_account" class="reset_cancel" value="Eliminar mi Cuenta" onclick="popUpUserDelete(<?php echo $user_id?>)"/>
                        <input type="submit" id="i_send_data" class="submit_input" value="Actualizar Datos"/>
                    </div>
                </form>
            </section>

            <section class="col col-50">
                <form id="f_password" name="f_password" class="form_data" onsubmit="return updatePassword(event)"
                    method="POST">

                    <input type="hidden" name="user_code" id="user_code_pass" value="<?php echo $user_id ?>" />
                    <input type="hidden" name="currentMD5" id="md5" value="<?php echo $passMD5 ?>" />

                    <label for="i_password" class="l_i_text">Contraseña Actual:</label>
                    <input type="password" name="i_password" id="i_password" class="text_input" 
                    onkeyup="return passwordFormatValidation(this)" 
                    onblur="passwordError(this)"/>
                    <br>

                    <label for="i_password" class="l_i_text">Nueva Contraseña:</label>
                    <input type="password" name="i_password_2" id="i_password_2" class="text_input" 
                    onkeyup="return passwordFormatValidation(this)" 
                    onblur="passwordError(this)"/>
                    <br>
                    <span id="s_password_notice" class="s_error_validation"></span>

                    <div class="d_button_container">
                        <input type="submit" id="i_send_password" class="submit_input" value="Actualizar Contraseña"/>
                    </div>
                </form>
            </section>
            <div id="pop-up" class="pop-up">
		    </div>
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
                    <legend>Gestionar mi Cuenta</legend>
                    <nav>
                    <a class="nav_a" href="my_account.php">Mi Cuenta</a>
                    <a class="nav_a" href="../../../config/close_session.php"> Cerrar Sesión</a>
                    </nav>
                </fieldset>
            </div>

            <div class="cont_pie">
                <fieldset>
                    <legend>Gestión de Teléfonos</legend>
                    <nav>
                        <a class="nav_a" href="phones.php">Mis Teléfonos</a>
                        <a class="nav_a" href="manage_phones.php?tel_codigo=-1">Gestionar mis Teléfonos</a>
                    </nav>
                </fieldset>
            </div>
        </footer>
    </body>
</html>