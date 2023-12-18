// Action de rechercher dans la BD 
function onDelete(e) {
    // Récupération de l'entrée
    let td = e.target;
     // 
    // Recupère le père de ce td : un tr
    let tr = td.parentElement;
    // Demande à la vue de récupérer l'id à partir de cette ligne
    let id = view.getIdFromRow(tr);
    // Demande une confirmation de la destruction
    if (confirm("Voulez vous détruire ce contact ?")) {
        // Demande au modèle de supprimer cet élément
        Contact.delete(id);
        // Demande à la vue de supprimer cette colonne
        view.deleteRow(tr);
    }

}

// Parcourt la table pour attacher le bouton
for (let i = 0; i < view.deleteButtons.length; i++) {
    view.deleteButtons[i].onclick = onDelete;
}