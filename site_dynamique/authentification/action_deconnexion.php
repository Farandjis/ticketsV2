<?php
session_start();

if (isset($_SESSION['login'], $_SESSION['mdp'])){
    unset($_SESSION['login'], $_SESSION['mdp']);
}
session_destroy();
header('Location: index.php');
?>

