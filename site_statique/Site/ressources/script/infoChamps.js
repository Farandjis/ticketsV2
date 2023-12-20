function afficheInfo(el) {
    var conteneur = document.getElementById("conteneur_infoChamps");
    var element = el.getAttribute("id");

    conteneur.style.display = 'block';

    while (conteneur.firstChild){
        conteneur.firstChild.remove();
    }

    var info = document.createElement("p")

    if (element === "infoLogin"){
        info.innerHTML = 'Le login doit contenir entre 5 et 32 caractères.'
    }
    if (element === "infoMdp"){
        info.innerHTML = 'Le mot de passe doit contenir entre 12 et 32 caractères et au moins une minuscule, une majuscule, un chiffre, un caractère spécial.'
    }
    if (element === "infoVerifMdp"){
        info.innerHTML = 'La vérification du mot de passe doit être identique au mot de passe.'
    }
    if (element === "infoNom"){
        info.innerHTML = 'Le Nom ne doit contenir que des lettres ou le caractère "-" et posséder entre 2 et 50 caractères.'
    }
    if (element === "infoPrenom"){
        info.innerHTML = 'Le Prénom ne doit contenir que des lettres ou le caractère "-" et posséder entre 2 et 50 caractères.'
    }
    if (element === "infoEmail"){
        info.innerHTML = 'L\'email doit avoir un format standard (ex: etudiant@ens.uvsq.fr)'
    }

    conteneur.appendChild(info)
}