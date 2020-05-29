function printError(idSpan, mesagge){
    var e_span = document.getElementById(idSpan);
    e_span.innerHTML = mesagge;
}

function validateInput(idSpan){
    var e_span = document.getElementById(idSpan);
    e_span.innerHTML = '';
    e_span.classList.remove("s_show");
}


function dniPhoneValidation(dni){
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
                validateInput("s_phone_notice");
                dni.classList.remove("s_input_error");
                return true;
            } else {
                printError("s_phone_notice", 'El número de cédula no es válida.');
                return false;
            } 
        } else {
            printError("s_phone_notice", 'Los dígitos de provincia y tipo de persona no son correctos.');
            return false;
        }

    } else {
        printError("s_phone_notice", 'Campo obligatorio, la cédula tiene 10 dígitos.');
        return false;
    }
}

function dniPhoneError(e){
    var dniValidate = dniPhoneValidation(e);
    if(!dniValidate){
        document.getElementById("s_phone_notice").classList.add("s_show");
        return false;
    }
    return true;
}

function listAdminPhones(keyword){
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
    xmlhttp.open("GET","../../../admin/controller/admin/filter_phones.php?keyword=" + keyword, true); 
    xmlhttp.send();
    return false;
}

function createAdminPhone(){
    var form = document.forms.namedItem("f_phone");
    var formData = new FormData(form);
    
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) { //alert("llegue"); 
            var e = document.getElementById("notice");
            e.innerHTML = this.responseText;
            e.classList.remove("e_hidden");
            // cancelAndClearUpdate("f_phone");
        } 
    };
    xmlhttp.open("POST","../../../admin/controller/admin/create_phone.php", true); 
    xmlhttp.send(formData);

    return false;
}

function readAdminPhone(formId, tel_id){
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
                var e = document.getElementById(formId);
                e.innerHTML = this.responseText;
                e.classList.remove("e_hidden");
                e.classList.add("e_show");
            } 
        };
        xmlhttp.open("GET","../../../admin/controller/admin/read_phone.php?tel_codigo=" + tel_id, true); 
        xmlhttp.send();
    }
    return false;
}

function updateAdminPhone(){
    var form = document.forms.namedItem("f_phone");
    var formData = new FormData(form);
    
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) { //alert("llegue"); 
            var e = document.getElementById("notice");
            e.innerHTML = this.responseText;
            e.classList.remove("e_hidden");
            cancelAndClearUpdate("f_phone");
            listAdminPhones("");
        } 
    };
    xmlhttp.open("POST","../../../admin/controller/admin/update_phone.php", true); 
    xmlhttp.send(formData);

    return false;
}

function resetPhoneAdmin(){
    var number = document.getElementById("i_phone_number");
    var radios = document.querySelectorAll('input[name="tel_type"]');
    var selComp = document.getElementById("s_company");
    var dni = document.getElementById("i_user_dni");

    dni.value = "";
    number.value = "";
    for (var radio of radios) {
        radio.checked = false;
    }
    selComp.selectedIndex = "0"

}

function submitAdminForm(){
    if(validatePhone()){
        createAdminPhone();
        resetPhoneAdmin();
    }

    return false;
}

function updateAdminForm(){
    if(validatePhone()){
        updateAdminPhone();
    }

    return false;
}

function validatePhone(){
    var formElements = document.getElementById("f_phone").elements;
    var nForm = formElements.length;
    var flag = true;
    var aux;

    for(var i = 0; i < nForm; i++){
        var e = formElements[i];

        switch (e.id){
            case "i_phone_number":
                aux = phoneError(e, 10);
                flag = aux && flag;
                if(!flag){
                    return flag;
                }
            break;

            case "i_user_dni":
                aux = dniPhoneError(e);
                flag = aux && flag;
                if(!flag){
                    return flag;
                }
            break;

            default:
                
        }
    }

    if(!typePhoneError()){
        flag = false;
        return flag;
    }

    if (!companyPhoneError()){
        flag = false;
        return flag;
    }

    return flag;
}
