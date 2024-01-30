function confirmerAvantEnvoi(elName) {
    // Ajoutez ici la logique pour retourner le bon texte selon le nom du formulaire submit
	
    switch(elName) {
        case 'Modifier le ticket':
            return window.confirm("Êtes-vous sûr de vouloir modifier ce ticket ?");
        case 'Finir le ticket':
            return window.confirm("Êtes-vous sûr de vouloir finir ce ticket ?");
        case 'Ajout Technicien':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce technicien ?");
		case 'Suppression Technicien':
			return window.confirm("Êtes-vous sûr de vouloir supprimer ce technicien ?");
		case 'Ajout Libelle':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce mot-clé ?");
        case 'Suppression Motcle':
            return window.confirm("Êtes-vous sûr de vouloir supprimer ce ou ces mot(s) clé(s) ?");
        case 'Ajout Titre':
            return window.confirm("Êtes-vous sûr de vouloir ajouter ce titre ?");
        case 'Suppression Titre':
            return window.confirm("Êtes-vous sûr de vouloir supprimer ce ou ces titre(s) ?");

        default:
            return alert("Mauvais nom de formulaire !");
    }
}
