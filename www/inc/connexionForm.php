<?php 
try{
    
    $bdd = new PDO('mysql:host=mtbenkheuxcv2018.mysql.db;dbname=mtbenkheuxcv2018', 'mtbenkheuxcv2018', 'Efispc93Abm34') or die(print_r($bdd->errorInfo()));
    // force la prise en charge de l'utf-8
    $bdd->exec ('SET NAMES utf8');
}catch(Exception $e){
    die('Erreur à debugger :' . $e->getMessage());
}