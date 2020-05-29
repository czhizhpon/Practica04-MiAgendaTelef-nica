function submitFormAdmin(evt, mode){
    evt.preventDefault();
    var formElements = document.getElementById("f_personal_data").elements;
    var nForm = formElements.length;
    var flag = true;
    var aux;

    if (!typeUserError()) {
        flag = false;
    }

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
                break;
        }
    }
    
    if (flag && mode == 1) {
        createUser();
    } else {
        updateUser();
    }

    return flag;
}

function submitFormPass(evt, mode){
    evt.preventDefault();
    var formElements = document.getElementById("f_personal_data").elements;
    var nForm = formElements.length;
    var flag = true;
    var aux;

    for(var i = 0; i < nForm; i++){
        var e = formElements[i];

        switch (e.id) {
            case "i_password":
                aux = passwordError(e);
                flag = flag && aux;
                break;
            case "i_password_2":
                aux = passwordError(e);
                flag = flag && aux;
                break;
            default:
                break
        }
    }

    if (flag) {
        updatePassword();
    }
    
    return flag; 
}

function validatePasswords(){

}

function typeUserError(){
    var radios = document.querySelectorAll('input[name="usu_type"]');
    var e_span = document.getElementById("s_type_notice");
    var selectedValue;
    
    for (var radio of radios) {
        if (radio.checked) {
            selectedValue = radio.value;
            break;
        }   
    }
    
    if (!selectedValue) {
        e_span.classList.add("s_show");
        printValidationError("s_type_notice", "Seleccione el tipo de Usuario.");
        document.getElementById("type_user_container").classList.add("e_input_trans_backg");
        return false;
    }

    document.getElementById("type_user_container").classList.remove("e_input_trans_backg");
    validate("s_type_notice");

    return true;
}

function createUser(){
    var admin_id = document.getElementById("admin_code");
    var message = document.getElementById("notice");

    var form = document.forms.namedItem("f_personal_data");
    var formData = new FormData(form);
    

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        message.classList.remove("e_hidden");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                message.classList.remove("e_hidden");
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/admin/create_user.php", true);
        xmlhttp.send(formData);
    }

    return false;
}

function readUser(formId, userId, readAction) {
    var admin_id = document.getElementById("admin_code");

    if (admin_id == "") {
        // Pendiente de poner en algun lugar el error
        console.log("Ocurrio algo inesperado");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var e = document.getElementById(formId);
                e.innerHTML = this.responseText;
                e.classList.remove("e_hidden");
                e.classList.add("e_show");
            }
        };

        xmlhttp.open("GET", "../../../admin/controller/admin/read_user.php?admin_id=" + admin_id 
                        + "&user_id=" + userId +"&readAction=" + readAction, true);
        xmlhttp.send();
    }

    return false;
}

function updateUser(){
    var message = document.getElementById("notice");

    var form = document.forms.namedItem("f_password");
    var formData = new FormData(form);
    

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        message.classList.remove("e_hidden");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                message.classList.remove("e_hidden");
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/admin/update_user.php", true);
        xmlhttp.send(formData);
    }

    return false;
}

function deleteUser(user_id){
    var admin_id = document.getElementById("admin_code").value;
    var state = "E";

    if (user_id == "") {
        console.log("Ha ocurrido algo");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                var key = document.getElementById("i_filter").value;
                filterUsers(key, 1);
            }
        };

        xmlhttp.open("GET", "../../../admin/controller/admin/change_state_user.php?admin_id=" + admin_id 
        + "&user_id=" + user_id + "&state=" + state, true);
        xmlhttp.send();
    }

    return false;
}

function restoreUser(user_id){
    var admin_id = document.getElementById("admin_code").value;
    var state = "N";

    if (user_id == "") {
        console.log("Ha ocurrido algo");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                var key = document.getElementById("i_filter").value;
                filterUsers(key, 1);
            }
        };

        xmlhttp.open("GET", "../../../admin/controller/admin/change_state_user.php?admin_id=" + admin_id 
        + "&user_id=" + user_id + "&state=" + state, true);
        xmlhttp.send();
    }

    return false;
}

function updatePassword(){
    var admin_id = document.getElementById("admin_code");
    var message = document.getElementById("notice");

    var form = document.forms.namedItem("f_password");
    var formData = new FormData(form);
    

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        message.classList.remove("e_hidden");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                message.classList.remove("e_hidden");
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/admin/update_user_password.php", true);
        xmlhttp.send(formData);
    }

    return false;
}

function listUser(action){
    var admin_id = document.getElementById("admin_code").value;
    
    if (admin_id == "") {
        // Pendiente de poner en algun lugar el error
        console.log("Ocurrio algo inesperado");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            //alert("A este si");
            //No llega aca
            if (this.readyState == 4 && this.status == 200) {
                console.log("Llega");
                //alert("Esta");
                document.getElementById("user_data").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../../../admin/controller/admin/list_users.php?admin_id=" + admin_id + "&action=" + action, true);
        xmlhttp.send();
    }

    return false;
}

function filterUsers(key, action){
    var admin_id = document.getElementById("admin_code").value;
    //var key = document.getElementById("i_filter").value;

    if (admin_id == "") {
        // Pendiente de poner en algun lugar el error
        console.log("Ocurrio algo inesperado");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("user_data").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "../../../admin/controller/admin/filter_users.php?admin_id=" + admin_id 
                        + "&key=" + key + "&action=" + action, true);
        xmlhttp.send();
    }

    return false;
}

function cancel(formID){
    var form = document.getElementById(formID);
    form.innerHTML = "";
    form.classList.add("e_hidden");
    form.classList.remove("e_show");
}
