//////////////// Partie Modèle //////////////////////
function convertir(celcius){
    return 1.8*celcius+32.0;
}


//////////////// Partie Vue  ///////////////////////
let view = {
    // L'élément DOM qui contient la valeur en entrée
    input : document.getElementsByTagName("input")[0],
    // L'élément DOM qui contient la valeur en sortie
    output : document.getElementsByTagName("output")[0],
    // L'élément DOM où acrocher le contrôleur
    b : document.getElementsByTagName("button")[0],
}


//////////////// Partie Contrôleur /////////////////
function onConvert(){
    let nbInput = Number(view.input.value);
    let output = convertir(nbInput);
    view.output.textContent = output;
}


// Attache le gestionaire (controleur)
view.b.onclick = onConvert;

