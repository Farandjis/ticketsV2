<?php
header("refresh: 10");

// $cmd = shell_exec("echo 'Thé0r!x//s0!r3' | su administration_tix -c 'cat /var/log/fail2ban.log ' | sed 's/$/;/'");
$cmd = shell_exec("echo 'miammiamvendredi!457' | su administration_tix -c 'echo \"miammiamvendredi!457\" | sudo -S cat /var/log/fail2ban.log | sed \"s/$/;/\"'");

if ($cmd == null){
    echo "<br> Erreur lors de l'exécution de la commande Linux !<br>";
    return;
}

echo "<p><b>fail2ban.log</b></p>";

$historique = ""; $ligneencours = "";
for ($i = 0; $i < strlen($cmd); $i++){
    if ($cmd[$i] == ';'){$historique = "$ligneencours<br>" . $historique; $ligneencours = ""; }
    else { $ligneencours .= $cmd[$i]; }
}
echo($historique);

$cmd = shell_exec("echo 'miammiamvendredi!457' | su administration_tix -c 'echo \"miammiamvendredi!457\" | sudo -S cat /var/log/fail2ban.log.1 | sed \"s/$/;/\"'");

if ($cmd == null){
    echo "<br> Erreur lors de l'exécution de la commande Linux !<br>";
    return;
}

echo "<p><b>fail2ban.log.1</b></p>";
$historique = ""; $ligneencours = "";
for ($i = 0; $i < strlen($cmd); $i++){
    if ($cmd[$i] == ';'){$historique = "$ligneencours<br>" . $historique; $ligneencours = ""; }
    else { $ligneencours .= $cmd[$i]; }
}

echo($historique);

$cmd = shell_exec("echo 'A' | su fteam -c 'echo \"A\" | sudo -S cat /var/www/logs/journauxActvCoInf.csv | sed \"s/$/;/\"'");

if ($cmd == null){
    echo "<br> Erreur lors de l'exécution de la commande Linux !<br>";
    return;
}

echo "<p><b>fail2ban.log.1</b></p>";
$historique = ""; $ligneencours = "";
for ($i = 0; $i < strlen($cmd); $i++){
    if ($cmd[$i] == ';'){$historique = "$ligneencours<br>" . $historique; $ligneencours = ""; }
    else { $ligneencours .= $cmd[$i]; }
}

echo($historique);

echo "<br>-- le fichier nanana.php n'a pas planté";

?>
