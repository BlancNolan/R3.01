//exercice 1.2
let n = "c";
while (isNaN(n)){
    n = prompt("entrer un nombre ");
}
console.log("Voici la table du " + n);
for(let i = 1; i <= 10;i++){
    console.log(i+" x "+n+" = "+i*n);
}

//exercie 1.3
function presenter(personne) {
    let texte = "Bonjour, je suis ";
    texte += personne.nom;
    texte += ". J'ai deux enfants : ";
    texte += personne.enfants[1].nom;
    texte += " et ";
    texte += personne.enfants[2].nom;
    return texte;
  }