let n = "c";
while (isNaN(n)){
    n = prompt("Entrer un nombre :");
}

let resultat = "Voici la table du "+n+" :\n";
for(let i = 1; i <= 10;i++){
    resultat += i+" x "+n+" = "+i*n+"\n";
}

console.log(resultat);
document.getElementsByTagName("pre")[0].textContent = resultat;
console.log(document.getElementsByTagName("pre"));

