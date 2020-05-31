<?php 
    include '../../../config/conexionBD.php';

    $admin_id = $_GET['admin_id'];
    $user_id = $_GET['user_id'];
    $readAction = $_GET['readAction'];

    $sqlUser = "SELECT * FROM usuarios WHERE usu_codigo LIKE '$user_id'";
    
    $resultUser = $conn->query($sqlUser);

    if ($resultUser) {

        if ($resultUser->num_rows > 0) {

            while ($rowUser = $resultUser->fetch_assoc()) {

                if ($readAction == 1) {

                    switch ($rowUser['usu_rol']) {
                        case 'U':
                            $type_U = "<input type=\"radio\" id=\"r_u\" name=\"usu_type\" value=\"U\" 
                            class=\"i_radio\" onclick=\"typeUserError()\" checked=\"checked\" />";
                            $type_A = "<input type=\"radio\" id=\"r_a\" name=\"usu_type\" value=\"A\" 
                            class=\"i_radio\" onclick=\"typeUserError()\" />";
                            break;
                        case 'A':
                            $type_U = "<input type=\"radio\" id=\"r_u\" name=\"usu_type\" value=\"U\" 
                            class=\"i_radio\" onclick=\"typeUserError()\" />";
                            $type_A = "<input type=\"radio\" id=\"r_a\" name=\"usu_type\" value=\"A\" 
                            class=\"i_radio\" onclick=\"typeUserError()\" checked=\"checked\" />";
                            break;
                        default:
                            # code...
                            break;
                    }
                    
                    echo "<input type=\"hidden\" name=\"user_code\" id=\"user_code\" value='". $user_id ."'></input>";
    
                    echo "<label for=\"i_dni\" class=\"l_i_text\">Cédula:</label>";
                    echo "<input type=\"text\" name=\"i_dni\" id=\"i_dni\" class=\"text_input\" 
                            onkeypress=\"return nNumberValidate(event, 10)\" 
                            onkeyup=\"dniFormatValidation(this)\" 
                            onblur=\"dniError(this)\" value='". $rowUser['usu_cedula'] ."'/><br>";
                    echo "<span id=\"s_dni_notice\" class=\"s_error_validation\"></span><br>";
    
                    echo "<label for=\"i_name\" class=\"l_i_text\">Nombres:</label>";
                    echo "<input type=\"text\" name=\"i_name\" id=\"i_name\" class=\"text_input\" 
                            onkeypress=\"return onlyTextInput(event)\" 
                            onkeyup=\"nStringValidate(this, 2, 's_name_notice')\" 
                            onblur=\"nameError(this, 2)\" value='". $rowUser['usu_nombre'] ."'/><br>";
                    echo "<span id=\"s_name_notice\" class=\"s_error_validation\"></span><br>";
    
                    echo "<label for=\"i_lastname\" class=\"l_i_text\">Apellidos:</label>";
                    echo "<input type=\"text\" name=\"i_lastname\" id=\"i_lastname\" class=\"text_input\" 
                            onkeypress=\"return onlyTextInput(event)\" 
                            onkeyup=\"nStringValidate(this, 2, 's_lastname_notice')\" 
                            onblur=\"lastnameError(this, 2)\" value='". $rowUser['usu_apellido'] ."'/><br>";
                    echo "<span div id=\"s_lastname_notice\" class=\"s_error_validation\"></span><br>";
                    
                    echo "<label for=\"i_address\" class=\"l_i_text\">Dirección:</label>";
                    echo "<input type=\"text\" name=\"i_address\" id=\"i_address\" class=\"text_input\" 
                            onkeyup=\"addressEmptyValidation(this)\" onblur=\"addressError(this)\" 
                            value='". $rowUser['usu_direccion'] ."'/><br>";
                    echo "<span id=\"s_address_notice\" class=\"s_error_validation\"></span><br>";
                    
                    echo "<label for=\"i_born\" class=\"l_i_text\">F. Nacimiento:</label>";
                    echo "<input type=\"date\" name=\"i_born\" id=\"i_born\" class=\"text_input\"
                            onkeyup=\"dateFormatValidation(this)\" onblur=\"dateError(this)\" 
                            value='". $rowUser['usu_fecha_nacimiento'] ."'/><br>";
                    echo "<span id=\"s_born_notice\" class=\"s_error_validation\"></span><br>";
                    
                    echo "<label for=\"i_email\" class=\"l_i_text\">Email:</label>";
                    echo "<input type=\"text\" name=\"i_email\" id=\"i_email\" class=\"text_input\" 
                            onkeyup=\"emailFormatValidation(this)\" onblur=\"emailError(this)\" 
                            value='". $rowUser['usu_correo'] ."'/><br>";
                    echo "<span id=\"s_email_notice\" class=\"s_error_validation\"></span><br>";
                    
                    echo "<label class=\"l_i_text l_r_text\">Tipo de Usuario:</label>";
                    echo "<div id=\"type_user_container\" class=\"i_r_container\">"
                        . $type_U .
                        "<label for=\"r_u\" class=\"l_radio\" name=\"usu_type_label\">Usuario</label><br>"
                        . $type_A .
                        "<label for=\"r_a\" class=\"l_radio\" name=\"usu_type_label\">Administrador</label><br>
                        </div>";
                    echo "<span id=\"s_type_notice\" class=\"s_error_validation\"></span><br>";
    
                    echo "<div class=\"d_button_container\">
                        <input type=\"button\" id=\"i_cancel\" class=\"reset_cancel\" value=\"Cancelar\" onclick='cancel(\"f_personal_data\")' />
                        <input type=\"submit\" id=\"i_update_user\" class=\"submit_input\" value=\"Actualizar\"/>
                    </div>";

                } else {
                    
                    echo "<input type=\"hidden\" name=\"user_code\" id=\"user_code\" value='". $user_id ."'></input>";
                    
                    echo "<span id=\"title\">Restablecer contraseña para: ".
                    $rowUser['usu_apellido'] .", ". $rowUser['usu_nombre']."</span><br>"; 
                    echo "<label for=\"i_password\" class=\"l_i_text\">Nueva contraseña:</label>";
                    echo "<input type=\"password\" name=\"i_password\" id=\"i_password\" class=\"text_input\" 
                            onkeyup=\"return passwordFormatValidation(this)\" onblur=\"passwordError(this)\"/><br>";
                    echo "<span id=\"s_password_notice\" class=\"s_error_validation\"></span><br>";
                    
                    echo "<span id=\"s_temp_notice\" class=\"s_error_validation\"></span><br>";
    
                    echo "<div class=\"d_button_container\">
                        <input type=\"reset\" id=\"i_cancel\" class=\"reset_cancel\" value=\"Cancelar\" onclick='cancel(\"f_password\")' />
                        <input type=\"submit\" id=\"i_update_user\" class=\"submit_input\" value=\"Actualizar\"/>
                    </div>";

                }

            }

        } else {
            echo " <p>Error: Surgio algo inesperado. </p>";
        }

    } else {
        echo " <p>Error: " . mysqli_error($conn) . "</p>";
    }

    $conn->close();
?>