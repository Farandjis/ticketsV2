<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Système'));

# Note à moi même : aller voir https://christophe.cucciardi.fr/fail2ban-lister-et-trier-les-ip-bannies/

session_start();

if ((isset($_SESSION['logadm'], $_SESSION['mdpadm'])) and $_SESSION['logadm'] == "administration_tix"){
    $cmd = shell_exec("echo '".htmlspecialchars($_SESSION['mdpadm'])."' | su administration_tix -c 'echo \"Accès à la page Modération de TIX [COOKIE].\"'");
    if ($cmd == null){ header('Location: ../authentification/action_deconnexion.php'); return;} // Si on a PAS réussit à se connecter, on déconnecte l'admin sys (car piratage)
} else { header('Location: ../authentification/action_deconnexion.php'); return;}

$logadm = "administration_tix";
$mdpadm = $_SESSION['mdpadm'];
// On change d'utilisateur Linux. On passe d'Apache à celui indiqué
$debutcmdADM = "echo '$mdpadm' | su $logadm -c 'echo \"$mdpadm\" | sudo -S "; // Ne pas oublier le ' à la fin de la commande.



try {

    // En premier lieu, on récupère la liste de prison fail2ban
    // Source : https://www.debian-fr.org/t/fail2ban-list-des-jails/76606/2 puis ChatGPT

    // Exécute la commande fail2ban-client status pour obtenir la liste des jails, filtre le résultat afin de n'avoir que les noms de prisons commençant par TIX
    $output = shell_exec($debutcmdADM . 'fail2ban-client status | grep "Jail list" | sed -E "s/^[^:]+:[ \t]+//" | sed "s/,//g" | grep -o "TIX[^ ]*"\'');
    // Exemple d'output (sans le filtrage supplémentaire 'TIX') : $output = "ssh apache nginx";
    // $output = "TIX_connexionSite_PRISON";
    // Supprime les espaces inutiles autour de la liste des jails et divise la chaîne en un tableau
    $prisons = explode("\n", trim($output));


    // Si on veut configurer une prison, on vérifie que tous les champs sont bien remplis.
    if (isset($_POST['modif-config-prison'], $_POST['prison'], $_POST['nb-tentative'], $_POST['nb-temps-oubli'], $_POST['temps-banni'])) {
        $prison = $_POST['prison']; $nb_tentative = $_POST['nb-tentative']; $nb_temps_oubli = $_POST['nb-temps-oubli']; $temps_banni = $_POST['temps-banni'];
        // La prison indiquée n'existe pas. Entrée invalide.
        if (! in_array($prison, $prisons)){ header('Location: moderation.php?id=-1#lesFormulaires'); return;}
        // Le nombre de tentative indiquée n'est pas compris entre 0 et 10. Entrée invalide.
        if (! (0 <= $nb_tentative and $nb_tentative <= 10)){ header('Location: moderation.php?id=-1#lesFormulaires'); return;}
        // Le temps avant l'oubli de la tentative est invalide.
        if (! (300 <= $nb_temps_oubli and $nb_temps_oubli <= 1800)){ header('Location: moderation.php?id=-1#lesFormulaires'); return;}
        // Pour temps bannis, de même
        if (! (120 <= $temps_banni and $temps_banni <= 3600)){ header('Location: moderation.php?id=-1#lesFormulaires'); return;}

        // Arrivé ici, les données envoyés sont valide. On peut donc exécuter notre commande LINUX

        // On exécute le script shell. Le script refera la vérification.
        $cmd = shell_exec($debutcmdADM . " sh /var/www/autorisation_acces/modifierPrison.sh $prison $nb_tentative $nb_temps_oubli $temps_banni'");

        if ($cmd == null){ echo header('Location: moderation.php?id=-2#lesFormulaires'); return; } // Echec exécution commande
        else { echo header('Location: moderation.php?id=1#lesFormulaires'); return;} // Réussite

    }

    // Si on veut bannir une IP dans une certaine prison
    elseif (isset($_POST['submit_bannir_ip'], $_POST['prison2'], $_POST['bannir_ip'])){
        $prison = $_POST['prison2']; $ip = $_POST['bannir_ip'];

        // Si c'est un message d'info et pas une IP qui était sélectionné :
        if ($ip == ""){ echo header('Location: moderation.php?id=-25#lesFormulaires'); return; }

        // On vérifie la validité de l'IP. Si elle n'est pas valide :
        if (! filter_var($ip, FILTER_VALIDATE_IP)){ echo header('Location: moderation.php?id=-20#lesFormulaires'); return; }

        // On vérifie que l'administrateur ne bannis pas son ordinateur :
        if ($ip == $_SERVER['REMOTE_ADDR']){ echo header('Location: moderation.php?id=-22#lesFormulaires'); return; }

        // On vérifie que l'administrateur ne bannis pas son ordinateur :
        if ($ip == $_SERVER['SERVER_ADDR']){ echo header('Location: moderation.php?id=-23#lesFormulaires'); return; }

        $cmd = shell_exec($debutcmdADM . "fail2ban-client set $prison banip $ip'");

        if ($cmd == null){ echo header('Location: moderation.php?id=-21#lesFormulaires'); return; } // Echec exécution commande
        else { echo header('Location: moderation.php?id=20#lesFormulaires'); return;} // Réussite
    }

    // Si on veut débannir une IP dans une certaine prison
    elseif (isset($_POST['submit_debannir_ip'], $_POST['prison2'], $_POST['debannir_ip'])){
        $prison = $_POST['prison2']; $ip = $_POST['debannir_ip'];

        // Si c'est un message d'info et pas une IP qui était sélectionné :
        if ($ip == ""){ echo header('Location: moderation.php?id=-25#lesFormulaires'); return; }

        // On vérifie la validité de l'IP. Si elle n'est pas valide :
        if (! filter_var($ip, FILTER_VALIDATE_IP)){ echo header('Location: moderation.php?id=-20#lesFormulaires'); return; }

        $testSiEstBan = shell_exec($debutcmdADM . "fail2ban-client status $prison | grep $ip'");
        if (empty($testSiEstBan)) { echo header('Location: moderation.php?id=-24#lesFormulaires'); return; }

        $cmd = shell_exec($debutcmdADM . "fail2ban-client set $prison unbanip $ip'");
        if ($cmd == null){ echo header('Location: moderation.php?id=-21#lesFormulaires'); return; } // Echec exécution commande
        else { echo header('Location: moderation.php?id=21#lesFormulaires'); return;} // Réussite
    }

    else {
        echo header('Location: moderation.php?id=0#lesFormulaires'); return;
    }
} catch (Exception $e) {
    echo header('Location: moderation.php?id=0#lesFormulaires'); return;
}