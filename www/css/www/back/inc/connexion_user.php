<?php

session_start(); // à mettre dans toutes les pages de l'admin
if (isset($_SESSION['connexion_admin'])) { // Si on est connecter on récupère les variables de sesion
$id_utilisateur=$_SESSION['id_utilisateur'];
$email=$_SESSION['email'];
$mdp=$_SESSION['mdp'];
$nom=$_SESSION['nom'];
// echo $id_utilisateur;
}else { 
    // Si on est pas connecté on ne peut peut pas se connecter
header('location:authentification.php');
}// Pour vider les variables de session destruy !

if (isset($_GET['quitter'])) { // On récupère le terme quitter en GET
$_SESSION['connexion_admin'] = '';
$_SESSION['id_utilisateur'] = '';
$_SESSION['email'] = '';
$_SESSION['nom'] = '';
$_SESSION['mdp'] = '';  
unset($_SESSION['connexion_admin']); // unset détruit la variable connexion_admin

session_destroy(); // On detruit la session    
header('location:authentification.php');
}
// Récupère les données de l'utilisateur par son id

$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs where id_utilisateur = '$id_utilisateur'");
$ligne_utilisateur = $sql-> fetch(); ?>