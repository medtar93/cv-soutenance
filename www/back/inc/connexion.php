<?php

//conexion à la BDD

$host='mtbenkheuxcv2018.mysql.db'; // le chemin ver le serveur de données
$database='mtbenkheuxcv2018'; // le nom de la base de données
$user='mtbenkheuxcv2018'; // le nom d'utilisateur pour se connecter
$psw='Efispc93Abm34';//mot de passe de l'utilisateur local (sur PC)

$pdoCV = new PDO('mysql:host='.$host.';dbname='.$database,$user,$psw);
//$pdoCV est le nom de la variable pour la connexion à la BDD qui nous sert
$pdoCV->exec("SET NAMES UTF8");
?>
