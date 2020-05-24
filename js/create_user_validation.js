
//Permite el ingreso de solo numeros
function onlyNumbersInput(evt){
    var currentAscii = evt.charCode;
    //console.log(currentAscii)
    if (currentAscii < 48 || currentAscii > 57){
        return false;
    }
    return true;
}

//Permite el ingreso de solo texto
function onlyTextInput(evt){
    var currentAscii = evt.charCode;
    if((currentAscii >= 65 && currentAscii <= 90) ||
        (currentAscii >= 97 && currentAscii <= 122) ||
        (currentAscii >= 192 && currentAscii <= 255) ||
        (currentAscii == 32)
    ){
        return true
    }
    return false;
}

//Permite un numero limitado de numeros
function nNumberValidate(evt, n){
    var onlyNumbers = onlyNumbersInput(evt);
    var e = evt.target;
    if(onlyNumbers){
        if(e.value.length == n){
            return false;
        }
        return true;
    }
    return false;
}

function dateDelimiter(evt){
    var current = evt.charCode;
    if(current == 47){
        return true;
    }
    return false;
}

function printValidationError(idSpan, mesagge){
    var e_span = document.getElementById(idSpan);
    e_span.innerHTML = mesagge;
}

function validate(idSpan){
    var e_span = document.getElementById(idSpan);
    e_span.innerHTML = '';
    e_span.classList.remove("s_show");
}

function dniFormatValidation(dni){
    var len = dni.value.length;
    var dni_length = (dni.value.length)*1;
    var total = 0;
    dni.classList.add("s_input_error")
    if(len == 10){
        var provinceDigit = (dni.value.substring(0,2))*1;
        var typeDigit = (dni.value.substring(2,3))*1;
        var dniCheckDigit = (dni.value.substring(9,10))*1;
        if ( (typeDigit<6) && (provinceDigit <= 24) ) {
            
            for (var index = 0; index < dni_length-1; index++) {
                
                var aux = (dni.value.substring(index, index+1))*1;

                if (index%2 == 0) {
                    aux = aux*2;
                    if (aux >= 10) {
                        aux -= 9;
                    }
                }
                total += aux;
            }
            var checkDigit = 0;
            if(total % 10 != 0){
                checkDigit = 10 - total % 10;
            }

            if (checkDigit == dniCheckDigit) {
                validate("s_dni_notice");
                dni.classList.remove("s_input_error");
                return true;
            } else {
                printValidationError("s_dni_notice", 'El número de cédula no es válida.');
                return false;
            } 
        } else {
            printValidationError("s_dni_notice", 'Los dígitos de provincia y tipo de persona no son correctos.');
            return false;
        }

    } else {
        printValidationError("s_dni_notice", 'Campo obligatorio, la cédula tiene 10 dígitos.');
        return false;
    }
}

function dniError(e){
    var dniValidate = dniFormatValidation(e);
    if(!dniValidate){
        document.getElementById("s_dni_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function nStringValidate(e, n){
    var val = e.value;
    var valString = val.split(" ");
    var nString = valString.length;
    var flag = false;
    
    e.classList.add("s_input_error");
    if (nString == n){
        for(var i = 0; i < nString; i++){
            if (valString[i].length <= 0){
                return false;
            }
        }
        e.classList.remove("s_input_error");
        validate("s_name_notice");
        return true;
    }
}

function nameError(e, n){
    var nStringVal = nStringValidate(e, n);
    if(!nStringVal){
        printValidationError("s_name_notice", "Se deben ingresar los dos nombres.");
        document.getElementById("s_name_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function lastnameError(e, n){
    var nStringVal = nStringValidate(e, n);
    if(!nStringVal){
        printValidationError("s_lastname_notice", "Se deben ingresar los dos apellidos.");
        document.getElementById("s_lastname_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function addressEmptyValidation(e){
    var addressString = e.value;
    e.classList.add("s_input_error");
    if(addressString.length == ""){
        return false
    }
    for(var i = 0; i < addressString.length; i++){
        if(addressString.charCodeAt(i) != 32){
            e.classList.remove("s_input_error");
            validate("s_address_notice");
            return true;
        }
    }
    return false;
}

function addressError(e){
    
    if(addressEmptyValidation(e)){
        document.getElementById("s_address_notice").classList.remove("s_show");
        return true;
    }else{
        printValidationError("s_address_notice", "Campo obligatorio.");
        document.getElementById("s_address_notice").classList.add("s_show");
        return false;
    }
}

function phoneValidate(e, n){
    if(e.value.length < n - 1){
        e.classList.add("s_input_error");
        return false;
    }else{
        validate("s_phone_notice");
        e.classList.remove("s_input_error");
        return true;
    }
}

function phoneError(e, n){
    if(!phoneValidate(e, n)){
        printValidationError("s_phone_notice", "Número de teléfono obligatorio.");
        document.getElementById("s_phone_notice").classList.add("s_show");
        return false;
    }
    return true;
}


function phoneCompanyEmptyValidation(e){
    var companyString = e.value;
    e.classList.add("s_input_error");
    if(companyString.length == 0){
        return false
    }
    for(var i = 0; i < companyString.length; i++){
        if(companyString.charCodeAt(i) != 32){
            e.classList.remove("s_input_error");
            validate("s_phone_notice");
            return true;
        }
    }
    return false;
}

function phoneCompanyError(e){
    if(!phoneCompanyEmptyValidation(e)){
        printValidationError("s_phone_notice", "Companía obligatoria.");
        document.getElementById("s_phone_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function dateFormatValidation(e){
    e.classList.add("s_input_error");
    if(e.value.length == 0){
        return false;
    }else{
        e.classList.remove("s_input_error");
        validate("s_born_notice");
        return true;
    }
}

function dateError(e){
    var dateValidation = dateFormatValidation(e);
    if(!dateValidation){
        printValidationError("s_born_notice", "Campo obligatorio.");
        document.getElementById("s_born_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function emailFormatValidation(e){
    var email_parts = e.value.split("@");
    e.classList.add("s_input_error");
    if (email_parts.length == 2) {
        if (email_parts[0].length >= 3) {

            if ((email_parts[1] == 'est.ups.edu.ec') || (email_parts[1] == 'ups.edu.ec')) {
                validate("s_email_notice");
                e.classList.remove("s_input_error");
                return true;
            } else {
                printValidationError("s_email_notice", 'Extensión de correo no perteneciente a la UPS.');
            }
        } else {
            printValidationError("s_email_notice", 'Extensión de usuario demasiado corta.');
        }
    } else {
        printValidationError("s_email_notice", 'Correo no válido.');
    }
    return false;
}

function emailError(e){
    var emailValidation = emailFormatValidation(e);
    if(!emailValidation){
        document.getElementById("s_email_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function passwordFormatValidation(e){
    var passString = e.value;
    var passLen = e.value.length;
    var charFormat = [false, false, false];
    var currentAscii;
    e.classList.add("s_input_error");
    if (passLen >= 8){
        for(var i = 0; i < passLen; i++){
            currentAscii = passString.charCodeAt(i);
            if(currentAscii >= 65 && currentAscii <= 90){
                charFormat[0] = true;
            }
            if(currentAscii >= 97 && currentAscii <= 122){
                charFormat[1] = true;
            }
            if(currentAscii == 64 || currentAscii == 95 || currentAscii == 36){
                charFormat[2] = true;
            }
        }
        for (var i = 0; i < 3; i++){
            if(charFormat[i] == false){
                printValidationError("s_password_notice", "Mínimo una letra minúscula." + 
                "<br>Mínimo una letra mayúscula. <br> Mínimo uno de estos símbolos [@,_,$].");
                return false;
            }
        }
        validate("s_password_notice");
        e.classList.remove("s_input_error");
        return true;
    }else{
        printValidationError("s_password_notice", 'Mínimo 8 caracteres.');
    }
    return false;
}

function passwordError(e){
    var passValidation = passwordFormatValidation(e);
    if(!passValidation){
        document.getElementById("s_password_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function submitForm(){
    var formElements = document.getElementById("f_personal_data").elements;
    var nForm = formElements.length;
    var flag = true;
    var aux;
    for(var i = 0; i < nForm; i++){
        var e = formElements[i];
        switch(e.id){
            case "i_dni":
                aux = dniError(e);
                flag = flag && aux;
                break;
            case "i_name":
                aux = nameError(e, 2);
                flag = flag && aux;
                break;
            case "i_lastname":
                aux = lastnameError(e, 2);
                flag = flag && aux;
                break;
            case "i_address":
                aux = addressError(e);
                flag = flag && aux;
                break;
            case "i_phone_number":
                aux = phoneError(e, 10);
                flag = flag && aux;
                break;
            case "i_born":
                aux = dateError(e);
                flag = flag && aux;
                break;
            case "i_email":
                aux = emailError(e);
                flag = flag && aux;
                break;
            case "i_password":
                aux = passwordError(e);
                flag = flag && aux;
                break;
            default:
                flag = false;
                console.log("No form elements");
        }
    }
    return flag;
}

class Phone{

    constructor(number, company){
        this.number = number;
        this.company = company;
    }
}

var userPhones = new Array();

class PhoneGUI{
    //var phones = new Array();

    createPhone(number, company){
        userPhones.push(new Phone(number, company));
    }

    deletePhone(index){
        userPhones.splice(index, 1);
    }

    printPhones(){
        var table = document.getElementById("user_numbers");
        var phone = document.getElementById("i_phones");
        var company = document.getElementById("i_companies");
        var list = `<tr>
            <th> Número</th>
            <th>Operadora</th>
            <th>Eliminar</th>
        </tr>`;

        var phones = "";
        var companies = "";

        for(var i = 0; i < userPhones.length; i++){
            // var e = document.createElement("tr");
            list = list + `<tr>
                <td> ${userPhones[i].number}  </td>
                <td> ${userPhones[i].company} </td>
                <td> <a href="#" id="ph${i}" name="delete_phone" class="btn btn_danger">Eliminar</td>
                </tr>`;
            phones = phones + `${userPhones[i].number},`;
            companies = companies + `${userPhones[i].company},`;
        }

        table.innerHTML = list;
        phone.value = phones;
        company.value = companies;
    }
}

var phoneGUI = new PhoneGUI();

function addPhone(){
    var number = document.getElementById("i_phone_number");
    var company = document.getElementById("i_phone_company");
    
    number.classList.add("s_input_error");
    company.classList.add("s_input_error");
    if(phoneError(number, 10) && phoneCompanyError(company)){
        phoneGUI.createPhone(number.value, company.value);
        phoneGUI.printPhones();
    
        number.value = "";
        company.value = "";
        validate("s_phone_notice");
        number.classList.remove("s_input_error");
    company.classList.remove("s_input_error");
    }else{
        printValidationError("s_phone_notice", "Número de teléfono y su compania son obligatorios.");
    }
}

function delPhone(evt){
    var e = evt.target;
    if(e.name == "delete_phone"){
        var index = "";
        for(var i = 2; i < e.name.length; i++){
            index = index + e.id.charAt(i);
        }
        phoneGUI.deletePhone(parseInt(index));
        phoneGUI.printPhones();
        
    }
    evt.preventDefault();
}
