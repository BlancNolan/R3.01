// Action de rechercher dans la BD 
function onRechercher() {
    // Récupération de l'entrée
    const pattern = view.input.value;
    // et passe à la vue
    Contact.readLike(pattern,function(contacts) { 
            view.show(contacts);
        });
}

// Attache le controleur au bouton
// Lance le controleur pour chaque nouveau caractères tapés
view.input.oninput = onRechercher;