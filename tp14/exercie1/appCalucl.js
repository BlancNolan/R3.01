/////////////////////////// Partie model //////////////////////////
function calculer(i){
    return i+1;
}

/////////////////////////// Partie view //////////////////////////
let view = {
    // L'élément DOM qui contient la valeur en entrée
    input : document.getElementsByTagName("input")[0],
    // L'élément DOM qui contient la valeur en sortie
    output : document.getElementsByTagName("output")[0],
    // L'élément DOM où acrocher le contrôleur
    button : document.getElementsByTagName("button")[0],
}

/////////////////////////// Partie controler //////////////////////////
function onCalculer(){
    let numberIn = Number(view.input.value);
    let output = calculer(numberIn);
    view.output.textContent = output;
}


view.button.onclick = onCalculer;