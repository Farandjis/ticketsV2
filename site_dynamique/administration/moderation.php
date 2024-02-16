<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">


</head>
<body>
    <h1 class="titre_page">Modération</h1>


    <div class="moderation">
        <div class="conteneur_table conteneur_table-moderation">
            <table class="table-moderation table-popup">
                <thead>
                <tr>
                    <th>Archive</th>
                    <th>Suppression</th>
                    <th>Télécharger</th>

                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TEST</td>
                        <td>X</td>
                        <td>TEL</td>

                    </tr>
                    <tr>
                        <td>TEST</td>
                        <td>X</td>
                        <td>TEL</td>

                    </tr>
                    <tr>
                        <td>TEST</td>
                        <td>X</td>
                        <td>TEL</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="conteneur_config-ban">
        <div class="conteneur_config-prison">
            <h1>Configuration des prisons</h1>
            <form action="#" method="post" class="config-prison">
                <label for="prison">Prison</label><br>
                <select id="prison">
                    <option value="1">Prison 1</option>
                    <option value="2">Prison 2</option>
                    <option value="3">Prison 3</option>
                </select><br>
                <label for="nb-tentative">Nombre de tentatives autorisées</label><br>
                <input type="number" min="1" id="nb-tentative"><br>
                <label for="nb-temps-oubli">Temps avant l'oubli de la dernière tentative</label><br>
                <input type="number" min="1" placeholder="temps en seconde" id="nb-temps-oubli"><br>
                <label for="temps-banni">Temps de banissement</label><br>
                <input type="number" min="1" placeholder="temps en seconde" id="temps-banni"><br>

                <div class="config-prison-submit">
                    <input type="submit" name="modif-config-prison" value="Configurer">
                </div>
            </form>

        </div>
        <div class="conteneur_ban-deban_IP">
            <form action="#" method="post" name="Bannir IP" onsubmit="return confirmerAvantEnvoi(this.name)">
                <h1>SSH / SFTP</h1>
                <label for="bannir_ip">Bannir une IP :</label><br>
                <div class="ban-deban_ip">
                    <input type="text">
                    <br>
                    <input type="submit" name="submit_bannir_ip" value="Bannir">
                </div>
            </form>

            <form action="#" method="post" name="Debannir IP" onsubmit="return confirmerAvantEnvoi(this.name)">
                <label for="debannir_ip">Débannir une IP :</label><br>
                <div class="ban-deban_ip">
                    <div class="custom-select">
                        <select name="selectionPossible" id="selectionPossible" required>
                            <option value="" selected>Selectioner une IP</option>
                            <option value="" >192.168.15.63</option>
                            <option value="" >192.168.80.152</option>
                        </select>
                    </div><br>
                    <input type="submit" name="submit_debannir_ip" value="Débannir">
                </div>
            </form>
        </div>
    </div>


</body>



'
