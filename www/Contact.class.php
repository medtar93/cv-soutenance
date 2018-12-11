<?php

// Contact.class.php 

class Contact {
    private $nom;
    private $email;
    private $sujet;
    private $message;

    //bonus email
    private $to;
    private $headers;

    // fonction d'insertion en BDD : 

    public function  insertContact($nom, $email, $sujet, $message){
        // 1- on récupére les saisie utilisateur
        $this->email = strip_tags($email);
        $this->nom = strip_tags($nom);
        $this->sujet = strip_tags($sujet);
        $this->message = strip_tags($message);

        // 2- on se connecte à la bdd
        require('connexionForm.php');
        // 3- on crée une requette d'insertion en 2 temps (prepare / execute)
        $req = $bdd->prepare('INSERT INTO contact (nom, email, sujet, message) VALUES (:nom, :email, :sujet, :message)');
            
        // dans mon execute() je vais affecter à la propriété nom, le nom de l'auteur qui vient poster un message 
        $req->execute([
            ':nom' => $this->nom,
            ':email' => $this->email,
            ':sujet' => $this->sujet,
            ':message' => $this->message
        ]);
        // 4- on ferme la requête (protection contre les injections malveillantes)
        $req->closeCursor();
    }

    // bonus envoie email

    public function sendEmail($sujet, $email, $message){
        $this->to = 'contact@mtbenkherouf.com';
        $this->email = strip_tags($email);
        $this->sujet = strip_tags($sujet);
        $this->message = strip_tags($message);
        $this->headers = 'De :' . $this->email . "\r\n"; // retour à la ligne
        $this->headers .= 'MIME-versions: 1.0' . "\r\n";
        $this->headers .= 'Content-type : text/html; charset=utf-8' . "\r\n";

        // enfin, on utilise la fonction prédéfinie mail() de PHP
        mail($this->to, $this->sujet, $this->message, $this->headers);
    }
}