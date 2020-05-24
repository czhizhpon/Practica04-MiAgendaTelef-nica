//Permite el ingreso de solo numeros
function onlyNumbersInput(evt){
    var currentAscii = evt.charCode;
    if (currentAscii < 48 || currentAscii > 57){
        return false;
    }
    return true;
}

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

function userPhonesError(){

    if(userPhones.length == 0){
        var numberInput = document.getElementById("i_phone_number");
        var companyInput = document.getElementById("i_phone_company");
        var e_span = document.getElementById("s_phone_notice");

        numberInput.classList.add("s_input_error");
        companyInput.classList.add("s_input_error");

        e_span.classList.add("s_show");
        printValidationError("s_phone_notice", "Número de teléfono y su compania son obligatorios.");
        return false;
    }
    return true;
}

function createPhone(){
    var number = document.getElementById("i_phone_number");
    var company = document.getElementById("i_phone_company");
    
    number.classList.add("s_input_error");
    company.classList.add("s_input_error");
    if(phoneError(number, 10) && phoneCompanyError(company)){
        number.value = "";
        company.value = "";
        validate("s_phone_notice");
        number.classList.remove("s_input_error");
        company.classList.remove("s_input_error");
    }else{
        printValidationError("s_phone_notice", "Número de teléfono y su compania son obligatorios.");
    }
}

function readPhone(){

}

function updatePhone(){

}

function deletePhone(evt){
    var e = evt.target;
    if(e.name == "delete_phone"){
        var index = "";
        for(var i = 2; i < e.name.length; i++){
            index = index + e.id.charAt(i);
        }
    }
    evt.preventDefault();
}
