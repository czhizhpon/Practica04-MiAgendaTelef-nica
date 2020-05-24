class Phone{

    constructor(number, operadora){
        this.number = number;
        this.operadora = operadora;
    }
}

var phones = new Array();

function createPhone(number, operadora){
    phones.concat(new Phone(number, operadora));
}

function deletePhone(index){
    phones.splice(index);
}
