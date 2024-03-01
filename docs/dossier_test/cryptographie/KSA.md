# fonction KSA

- ### Méthodologie employé
Nous allons tester la fonction KSA à l'aide de tests boîtes blanche et noir.<br>
En premier lieu, nous allons trouver les différents chemin possible dans le code, et on vas vérifier le fonctionnement du code grâce aux tests boîtes blanche.<br>
Pour les tests boîtes noir, nous allons tester différentes valeurs.<br>
Cependant, au vu de la taille importante du résultat et de la complexité de l'algorithme, nous avons comparer avec des résultats trouvés en ligne.<br>
De plus, on s'assure que le caractère espace est bien pris en compte dans une chaîne, et que celle ci ne se résumerais pas au premier mot avant l'espace.<br>

- ### Tests boîte blanche
<img src="src\cryptoksa1.png"/><br>
C1 = {0; 1; 3; 4; 5; 6; 7; 8}<br>
C2 = {0; 1; 2; 3; 4; 5; 6; 7; 8}<br>

| Cas | Entrée clefK  | Retour                           |
|-----|---------------|----------------------------------|
| C1  | ""            | Erreur : Modulo 0 pour la case 7 |
| C2  | "pomme"       | [112, 135, 79, ...]              |


- ### Tests boîte noir

| Cas | Entrée clefK       | Résultat obtenu                | Résultat attendu                  | Valide |
|-----|--------------------|--------------------------------|-----------------------------------|--------|
| 1   | ""                 | ERREUR : Modulo by zero        | ERREUR personnalisé : Clé absente | KO     |
| 2   | "Wiki"             | [256, 139, 160, 46, 154,  ...] | [256, 139, 160, 46, 154 ...]      | OK     |
| 3   | "Key"              | [75, 51, 132, 157, 192, ...]   | [75, 51, 132, 157, 192, ...]      | OK     |
| 4   | "Secret"           | [46, 181, 30, 147, 38, ...]    | [46, 181, 30, 147, 38, ...]       | OK     |
| 5   | "Wiki très secret" | [76, 145, 46, 115, 180, ...]   | [76, 145, 46, 115, 180, ...]      | OK     |

- ### Analyse de la pertinence de ces tests 
ici débat avantage/inconvénient d'un test b noir/blanche pour ce test là

|               | Avantage                                               | Inconvénient                                                                                                                            |
|---------------|--------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------|
| Boîte blanche | Plus facile à faire, on test simplement les conditions | Les cas sont limités au chemin étudiés qui correspondent à la validité ou non d'une condition.                                          |
| Boîte Noir    | On a la possibilité de faire plusieurs cas de tests    | Il est compliqué de deviner le résultat attendu sans utiliser un code déjà existant et fonctionnel : l'algorithme est long et complexe. |


- ### Test exécutable
phpunit fait maison

- faire analyse de groupe : 
- Morceau du code qui exécute le test boîte noir OU boîte blanche
