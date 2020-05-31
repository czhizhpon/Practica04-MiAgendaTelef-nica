function hideNotice(){
    document.getElementById("main_notice").classList.add("e_hidden");
}

function hidePopUp(){
    document.getElementById("pop-up").classList.remove("pop-up-show");
}

function popUpBuild(mesagge, acceptFunction){
    var popUp = `
    <p>${mesagge}</p>
    <div class="d_button_container">
        <button class="reset_cancel" onclick="hidePopUp()"> Cancelar</button>
        <button class="submit_input" onclick="${acceptFunction}">Aceptar</button>
    </div>
    `;
    var popup = document.getElementById("pop-up");
    popup.classList.add("pop-up-show");
    popup.innerHTML = popUp;
}

