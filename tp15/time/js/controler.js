// Action de dempander l'heure au serveur 
function onTime() {
    Time.read(view.input.value, view.show);
}
// Action 

// Attache le controleur au bouton
view.button.onclick = onTime;