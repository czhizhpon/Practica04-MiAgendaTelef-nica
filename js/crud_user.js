function submitForm(evt){
    evt.preventDefault();
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
    return flag;
}

function submitFormPass(evt){
    evt.preventDefault();
    var formElements = document.getElementById("f_password").elements;
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
    return flag; 
}

function updateUser(evt){
    var message = document.getElementById("notice"); 
    var list = document.getElementById("i_filter");

    var form = document.forms.namedItem("f_personal_data");
    var formData = new FormData(form);
    if(!submitForm(evt)){
        message.innerHTML = "<p class='e_notice e_notice_error'>Campos incorrectos.</p>";
        document.getElementById("main_notice").classList.remove("e_hidden");
    }else{
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                message.innerHTML = this.responseText;
                document.getElementById("main_notice").classList.remove("e_hidden");
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/user/update_user.php", true);
        xmlhttp.send(formData);
    
    }
    return false;
}

function popUpUserDelete(user_id){
    var mesagge = `¿Esta seguro que desea eliminar su cuenta?`;
    popUpBuild(mesagge, `deleteUser(${user_id})`);
}

function deleteUser(user_id){
    var message = document.getElementById("notice");
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
                hidePopUp();
                document.location.href = "../../../config/close_session.php";
            }
        };

        xmlhttp.open("GET", "../../../admin/controller/user/change_state_user.php", true);
        xmlhttp.send();
    }

    return false;
}

function updatePassword(evt){
    var message = document.getElementById("notice");

    var form = document.forms.namedItem("f_password");
    var formData = new FormData(form);
    

    if (!submitFormPass(evt)) {
        message.innerHTML = "<p class='e_notice e_notice_error'>Campos incorrectos.</p>";
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
                clearPassForm();
            }
        };

        xmlhttp.open("POST", "../../../admin/controller/user/update_user_password.php", true);
        xmlhttp.send(formData);
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
