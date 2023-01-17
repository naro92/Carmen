function check(){
    var texte_rapport = document.getElementById("bilan");
    var message_error = document.getElementById("p_error");
    if (texte_rapport.value == ""){
        message_error.innerHTML = "Veuillez écrire le rapport avant de l'envoyer";
        message_error.style.color = "red";
        return false;
    }
    else{
        return true;
    }
}