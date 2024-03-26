function confirmerAvantEnvoi(elName) {
    // Ajoutez ici la logique pour retourner le bon texte selon le nom du formulaire submit
    switch(elName) {
        case 'Modifier le ticket':
            return window.confirm("Êtes-vous sûr de vouloir modifier ce ticket ?");
        case 'Finir le ticket':
            return window.confirm("Êtes-vous sûr de vouloir finir ce ticket ?");
        case 'Ajout Technicien':
            return window.confirm("Êtes-vous sûr de vouloir modifier ce technicien ?");
        case 'Suppression Technicien':
            return window.confirm("Êtes-vous sûr de vouloir supprimer ce technicien?");
        case 'Ajout Libelle':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce libellé ?");
        case 'Suppression Motcle':
            return window.confirm("Êtes-vous sûr de vouloir supprimer ce ou ces mot(s) clé(s) ?");
        case 'Ajout Titre':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce titre ?");
        case 'Suppression Titre':
            return window.confirm("Êtes-vous sûr de vouloir supprimer ce ou ces titre(s) ?");
        case 'Suppresion Log':
            return window.confirm("Êtes-vous sûr de vouloir supprimer cette archive ?");
        case 'Bannir IP':
            return window.confirm("Êtes-vous sûr de vouloir bannir cette ip ?");
        case 'Debannir IP':
            return window.confirm("Êtes-vous sûr de vouloir debannir cette ip ?");
        case 'Bannir Compte':
            return window.confirm("Êtes-vous sûr de vouloir bannir cet utilisateur de la plateforme TIX ?");
        case 'Debannir Compte':
            return window.confirm("Êtes-vous sûr de vouloir DÉBANNIR cet utilisateur de la plateforme TIX ?");
        default:
            return window.confirm("Problème nom formulaire");
    }
}