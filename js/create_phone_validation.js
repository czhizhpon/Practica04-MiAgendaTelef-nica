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


class Phone{

    constructor(number, company){
        this.number = number;
        this.company = company;
    }
}

var userPhones = new Array();

class PhoneGUI{

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
            list = list + `<tr>
                <td> ${userPhones[i].number}  </td>
                <td> ${userPhones[i].company} </td>
                <td> <a href="#" id="ph${i}" name="delete_phone" class="btn btn_danger">Eliminar</a></td>
                </tr>`;
            phones = phones + `"${userPhones[i].number}",`;
            companies = companies + `"${userPhones[i].company}",`;
        }
        phones = phones.substring(0, phones.length - 1);
        companies = companies.substring(0, companies.length - 1);

        table.innerHTML = list;
        phone.value = phones;
        company.value = companies;
    }
}

var phoneGUI = new PhoneGUI();

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
