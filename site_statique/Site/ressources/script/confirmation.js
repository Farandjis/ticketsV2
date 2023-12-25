function confirmerAvantEnvoi(elName) {
    // Ajoutez ici la logique pour retourner le bon texte selon le nom du formulaire submit
    switch(elName) {
        case 'Modifier le ticket':
            return window.confirm("Êtes-vous sûr de vouloir modifier ce ticket ?");
        case 'Finir le ticket':
            return window.confirm("Êtes-vous sûr de vouloir finir ce ticket ?");
        case 'Ajout Technicien':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce technicien ?")
        case 'Ajout Libelle':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce libellé ?")
        default:
            return false
    }
}