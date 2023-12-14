// Définition des paramètres de la vue 
const view = {
    
    button : document.getElementsByTagName("button")[0],
    input : document.getElementsByTagName("input")[0],


    //  La zone de sortie
    output: document.getElementsByTagName("output")[0],

    // Fonction qui affiche une date dans la balise output
    show: function (time) {
        view.output.textContent = time.date;
    }
}
