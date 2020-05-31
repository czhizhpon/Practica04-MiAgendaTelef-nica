function submitFormAdmin(evt, mode){
    evt.preventDefault();
    var formElements = document.getElementById("f_personal_data").elements;
    var nForm = formElements.length;
    var flag = true;
    var aux;

    // Mode: 1=CREAR, 2=ACTUALIZAR USUARIO, 3=ACTUALIZAR MIS DATOS

    if (mode != 3) {
        if (!typeUserError()) {
            flag = false;
        }
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
    }
    
    if (flag && mode != 1) {
        updateUser(mode);
    }

    return flag;
}

function submitFormPass(evt, mode){
    evt.preventDefault();
    var formElements = document.getElementById("f_password").elements;
    var nForm = formElements.length;
    var flag = true;
    var aux;

    // Mode: 1=RESTRABLECER, 2=CAMBIAR

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
        updatePassword(mode);
    }
    return flag; 
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
        document.getElementById("main_notice").classList.remove("e_hidden");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                document.getElementById("main_notice").classList.remove("e_hidden");
                clearRegisterForm();
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/admin/create_user.php", true);
        xmlhttp.send(formData);
    }

    return false;
}

function readUser(formId, userId, readAction) {
    var admin_id = document.getElementById("admin_code");
    var message = document.getElementById("notice"); 

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
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

function updateUser(mode){
    var admin_id = document.getElementById("admin_code");
    var message = document.getElementById("notice"); 
    var list = document.getElementById("i_filter");

    var form = document.forms.namedItem("f_personal_data");
    var formData = new FormData(form);
    

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                document.getElementById("main_notice").classList.remove("e_hidden");
                if (mode == 2) {
                    cancel(form.getAttribute('id'));
                    filterUsers(list.value, 1);
                }
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/admin/update_user.php", true);
        xmlhttp.send(formData);
    }

    return false;
}

function deleteUser(user_id){
    var admin_id = document.getElementById("admin_code").value;
    var message = document.getElementById("notice");
    var state = "E";

    if (user_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
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
    var message = document.getElementById("notice");
    var state = "N";

    if (user_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
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

function updatePassword(mode){
    var admin_id = document.getElementById("admin_code");
    var message = document.getElementById("notice");
    var list = document.getElementById("i_filter");

    var form = document.forms.namedItem("f_password");
    var formData = new FormData(form);
    

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                document.getElementById("main_notice").classList.remove("e_hidden");
                if (mode == 1) {
                    cancel(form.getAttribute('id'));
                    filterUsers(list.value, 1);
                } else {
                    clearPassForm();
                }
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/admin/update_user_password.php", true);
        xmlhttp.send(formData);
    }

    return false;
}

function listUser(action){
    var admin_id = document.getElementById("admin_code").value;
    var message = document.getElementById("notice");
    
    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
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
        xmlhttp.open("GET", "../../../admin/controller/admin/list_users.php?admin_id=" + admin_id + "&action=" + action, true);
        xmlhttp.send();
    }

    return false;
}

function filterUsers(key, action){
    var admin_id = document.getElementById("admin_code").value;
    var message = document.getElementById("notice");
    //var key = document.getElementById("i_filter").value;

    if (admin_id == "") {
        message.innerHTML = "<span>Ha ocurrido algo inesperado. <span>";
        document.getElementById("main_notice").classList.remove("e_hidden");
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

function clearRegisterForm(){
    document.getElementById("i_dni").value = "";
    document.getElementById("i_name").value = "";
    document.getElementById("i_lastname").value = "";
    document.getElementById("i_address").value = "";
    document.getElementById("i_born").value = "";
    document.getElementById("i_email").value = "";
    document.getElementById("i_password").value = "";

    var radios = document.querySelectorAll('input[name="usu_type"]');

    for (let radio of radios) {
        radio.checked = false;
    }
}

function clearPassForm(){
    document.getElementById("i_password").value = "";
    document.getElementById("i_password_2").value = "";
}
