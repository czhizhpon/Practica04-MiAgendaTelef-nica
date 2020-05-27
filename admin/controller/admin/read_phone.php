<?php
    include '../../../config/conexionBD.php';

    $tel_codigo = $_GET['tel_codigo'];
    $sqlPhones = "SELECT * FROM telefonos LEFT JOIN usuarios ON telefonos.usu_codigo = usuarios.usu_codigo where tel_codigo like '$tel_codigo'";

    $resultPh = $conn->query($sqlPhones);
    if($resultPh){
        if ($resultPh -> num_rows > 0) {

            while($rowPh = $resultPh -> fetch_assoc()) {

                switch($rowPh['tel_tipo']){
                    case "CE":
                        $ce_type = "<input type='radio' id='r_ce' name='tel_type' value='CE' class='i_radio'
                        onclick='typePhoneError()' checked='checked' >";
                        $co_type = "<input type='radio' id='r_co' name='tel_type' value='CO' class='i_radio'
                        onclick='typePhoneError()'>";
                    break;
                    case "CO":
                        $ce_type = "<input type='radio' id='r_ce' name='tel_type' value='CE' class='i_radio'
                        onclick='typePhoneError()'>";
                        $co_type = "<input type='radio' id='r_co' name='tel_type' value='CO' class='i_radio'
                        onclick='typePhoneError()' checked='checked'>";
                    break;

                    default:

                }
                // echo "<input type='hidden' name='i_user_codigo' id='i_user_id' value='" . $rowPh['usu_codigo'] . "'/>";
                echo "<input type='hidden' name='i_phone_id' id='i_phone_id' value='" . $rowPh['tel_codigo'] . "' />";
                
                echo "<label for='i_phone_number' class='l_i_text' >Número:</label>";
                echo "<input type='text' name='i_phone_number' id='i_phone_number' class='text_input' 
                    placeholder='Número'
                    onkeypress='return nNumberValidate(event, 10)' 
                    onkeyup='return phoneValidate(this, 10)'
                    onblur='phoneError(this, 10)'
                    value='" . $rowPh['tel_numero'] . "'/>
                
                <br/>
                
                <label class='l_i_text l_r_text'>Tipo:</label>
                <div id='type_phone_container' class='i_r_container'>
                    " . $co_type . "
                    <label for='r_co' class='l_radio' name='tel_type_label'>Convencional</label><br>
                    " . $ce_type . "
                    <label for='r_ce' class='l_radio' name='tel_type_label'>Celular</label><br>
                </div>

                <label for='s_company' class='l_i_text'>Operadora:</label>
                <select name='s_company' id='s_company' class='text_input sel_form' onclick='companyPhoneError()'>
                    <option value='NaN'>Seleccione...</option>
                    <option value='MOVISTAR'";
                if($rowPh['tel_operadora'] == 'MOVISTAR'){
                    echo "selected";
                }
                echo ">Movistar</option>
                    <option value='TUENTI'";
                if($rowPh['tel_operadora'] == 'TUENTI'){
                    echo "selected";
                }
                echo ">Tuenti</option>
                    <option value='CLARO'";
                if($rowPh['tel_operadora'] == 'CLARO'){
                    echo "selected";
                }
                echo ">Claro</option>
                    <option value='ETAPA'";
                if($rowPh['tel_operadora'] == 'ETAPA'){
                    echo "selected";
                }
                echo ">Etapa</option>
                    <option value='CNT'";
                if($rowPh['tel_operadora'] == 'CNT'){
                    echo "selected";
                }
                echo ">CNT</option>
                    <option value='OTROS'";
                if($rowPh['tel_operadora'] == 'OTROS'){
                    echo "selected";
                }
                echo ">Otros</option>
                </select>";

                echo "<label class='l_i_text l_r_text' >Eliminado:</label>";
                echo "<div id='eliminated_phone_container' class='i_c_container'>";
                if($rowPh["tel_eliminado"] == 'E'){
                    echo "<input type='checkbox' class='i_check' name='i_check_tel_eliminado' checked value='E' />";
                }else{
                    echo "<input type='checkbox' class='i_check' name='i_check_tel_eliminado' value='E'/>";
                }
                echo "</div>";
                echo "<label for='i_user_dni' class='l_i_text' >CI. Usuario:</label>";
                echo "<input type='text' name='i_user_dni' id='i_user_dni' class='text_input' 
                        placeholder='Ingrese CI.'
                        onkeyup='dniPhoneValidation(this)'
                        onblur='dniPhoneError(this)'
                        value='" . $rowPh['usu_cedula'] . "'/>";
                
                echo "</br>
                <span id='s_phone_notice' class='s_error_validation'></span>
                </br>
                <div class='d_button_container'>
                    <input type=\"reset\" class='reset_cancel' value='Cancelar' onclick='cancelAndClearUpdate(\"f_phone\")'/>
                    <input type=\"button\" id='i_send_u_phone' class='submit_input' onclick='updateAdminForm()' value='Actualizar'/>
                </div>";
                
            }
        } else {
            echo "<p>Algo salió mal.</p>";
        }
    }else{
        echo " <p>Error: " . mysqli_error($conn) . "</p>";
    }
    
    $conn->close();
?>