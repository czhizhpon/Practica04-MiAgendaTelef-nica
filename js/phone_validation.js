function printValidationError(idSpan, mesagge){
    var e_span = document.getElementById(idSpan);
    e_span.innerHTML = mesagge;
}

function validate(idSpan){
    var e_span = document.getElementById(idSpan);
    e_span.innerHTML = '';
    e_span.classList.remove("s_show");
}


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


function listPhones(user_id, action){
    if(user_id == ""){
        document.getElementById("phone_list").innerHTML == "Algo salió mal.";
    }else{
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) { //alert("llegue"); 
                document.getElementById("user_numbers").innerHTML = this.responseText; 
            } 
        };
        xmlhttp.open("GET","../../../admin/controller/user/list_phones.php?user_id=" + user_id + "&action=" + action, true); 
        xmlhttp.send();
    }
    return false;
}

function filterPhone(keyword, action){
    var user_id = document.getElementById("i_user_id").value;
    if(!keyword){
        listPhones(user_id, action);
    }else{
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) { //alert("llegue"); 
                document.getElementById("user_numbers").innerHTML = this.responseText; 
            } 
        };
        xmlhttp.open("GET","../../../admin/controller/user/filter_phone.php?keyword=" + keyword + "&user_id=" + user_id + "&action=" + action, true); 
        xmlhttp.send();
    }
    return false;
}

function createPhone(){
    var user_id = document.getElementById("i_user_id").value;
    var form = document.forms.namedItem("f_phone");
    var formData = new FormData(form);
    if(user_id == ""){
        document.getElementById("phone_list").innerHTML == "Algo salió mal.";
    }else{
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        document.getElementById("s_phone_notice").classList.add("s_show");
        xmlhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) { //alert("llegue"); 
                document.getElementById("s_phone_notice").innerHTML = this.responseText; 
                listPhones(user_id);
                resetFields();
                console.log("Se ejecuta");
            } 
        };
        xmlhttp.open("POST","../../../admin/controller/user/create_phone.php", true); 
        xmlhttp.send(formData);
    }
    
    return false;
}

function readPhone(form_id, tel_id){
    // alert("form: " + formId  + " | tel: " + tel_id);
    var user_id = document.getElementById("i_user_id").value;
    
    if(!tel_id){
        listPhones(user_id);
    }else{
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) { //alert("llegue"); 
                document.getElementById(form_id).innerHTML = this.responseText; 
            } 
        };
        xmlhttp.open("GET","../../../admin/controller/user/read_phone.php?tel_codigo=" + tel_id + "&usu_codigo=" + user_id, true); 
        xmlhttp.send();
    }
    return false;
}

function updatePhone(tel_id){

}

function deletePhone(evt){
    // var e = evt.target;
    // if(e.name == "delete_phone"){
    //     var index = "";
    //     for(var i = 2; i < e.name.length; i++){
    //         index = index + e.id.charAt(i);
    //     }
    // }
    // evt.preventDefault();
}

function typePhoneError(){
    var radios = document.querySelectorAll('input[name="tel_type"]');
    var selectedValue;
    var e_span = document.getElementById("s_phone_notice");

    for (var radio of radios) {
        if (radio.checked) {
            selectedValue = radio.value;
            break;
        }
    }
    if(!selectedValue){
        e_span.classList.add("s_show");
        printValidationError("s_phone_notice", "Seleccione el tipo de número.");
        document.getElementById("type_phone_container").classList.add("e_input_trans_backg");
        return false;
    }
    document.getElementById("type_phone_container").classList.remove("e_input_trans_backg");
    validate("s_phone_notice");
    return true;
}

function companyPhoneError(){
    var e = document.getElementById("s_company");
    var selValue = e.value;

    var e_span = document.getElementById("s_phone_notice");
    if(selValue == "NaN"){
        e_span.classList.add("s_show");
        printValidationError("s_phone_notice", "Seleccione una operadora.");
        e.classList.add("s_input_error");
        return false;
    }
    validate("s_phone_notice");
    e.classList.remove("s_input_error");
    return true;
}

function submitForm(evt){
    evt.preventDefault();
    var formElements = document.getElementById("f_phone").elements;
    var nForm = formElements.length;
    var flag = true;
    for(var i = 0; i < nForm; i++){
        var e = formElements[i];
        if(e.id == "i_phone_number" && !phoneError(e, 10)){
            flag = false;
        }
    }

    if(!typePhoneError()){
        flag = false;
    }

    if (!companyPhoneError()){
        flag = false;
    }

    if(flag){
        createPhone();
    }

    return flag;
}

function resetFields(){
    var number = document.getElementById("i_phone_number");
    var radios = document.querySelectorAll('input[name="tel_type"]');
    var selComp = document.getElementById("s_company");

    number.value = "";
    for (var radio of radios) {
        radio.checked = false;
    }
    selComp.selectedIndex = "0"
}