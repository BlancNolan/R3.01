/////////////////////// parti model ///////////////////////
function lanceDe(){
    return Math.floor(Math.random()*6+1);
}

/////////////////////// parti view ///////////////////////
let view = {
    //l'élémnet DOM qui contient la valeur de sortie
    output : document.getElementsByTagName("output")[0],
    //l'élémnet DOM où acrocher le contrôleur
    button : document.getElementsByTagName("button")[0],

}

/////////////////////// parti controler ///////////////////////
function onLancer(){
    let output = lanceDe();
    view.output.textContent = output;
}

view.button.onclick = onLancer;