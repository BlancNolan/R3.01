// Définition des paramètres de la vue 
const view = {
    // La zone input du header
    input: document.querySelector("header input"),
    // La zone de sortie, juste le body de la table dans le main
    tbody: document.querySelector("main table tbody"),

    
    // Fonction qui affiche un contact dans la table
    show: function (contacts) {
        
        // On vide le tbody
        this.tbody.innerHTML = "";

        // On parcourt le tableau de contacts
        for (let contact of contacts) {
            // On ajoute une ligne dans la table
            let tr = this.tbody.insertRow();
            // On ajoute une cellule dans la ligne
            let td = tr.insertCell();
            // On ajoute le nom dans la cellule
            td.innerText = contact.prenom;
            // On ajoute une cellule dans la ligne
            td = tr.insertCell();
            // On ajoute le prénom dans la cellule
            td.innerText = contact.nom;
            // On ajoute une cellule dans la ligne
            td = tr.insertCell();
            // On ajoute le téléphone dans la cellule
            td.innerText = contact.mobile;
            // On ajoute une cellule dans la ligne
            td = tr.insertCell();
        }
        
    },

    //  
};
