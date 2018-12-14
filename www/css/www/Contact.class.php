<?php

// Contact.class.php 

class Contact {
     private $nom;
     private $email;
     private $sujet;
     private $message;

     // bonus email
     private $to;
     private $headers;

     // fonction d'insertion en BDD :
     public function insertContact($nom, $email, $sujet, $message){
          // 1- on récupère les saisies de l'utilisateur
          // 2- on se connecte à la BDD
          // 3- on créé une requête d'insertion en 2 temps (prepare / execute)
          // 4- on ferme la requête (protection contre les injections malveillantes)

          // 1- on récupère les saisies de l'utilisateur
          $this->nom = strip_tags($nom);
          $this->email = strip_tags($email);
          $this->sujet = strip_tags($sujet);
          $this->message = strip_tags($message);

          // 2- on se connecte à la BDD
          require('inc/connexionForm.php');

          // 3- on créé une requête d'insertion en 2 temps (prepare / execute)
          $req = $bdd->prepare('INSERT INTO contact (nom, email, sujet, message) VALUES (:nom, :email, :sujet, :message)');

          // dans mon execute() je vais affecter à la propriété name, le name de l'auteur qui vient de poster un comment
          $req->execute([
               ':nom' => $this->nom,
               ':email' => $this->email,
               ':sujet' => $this->sujet,
               ':message' => $this->message
          ]);

          // $req->execute(array(
          //      ':name' => $this->name,
          // );

          // 4- on ferme la requête (protection contre les injections malveillantes)
          $req->closeCursor();
     }

     // bonus : envoi email
     public function sendEmail($nom, $email, $sujet, $message) {
          $this->to = 'contact@mtbenkherouf.com';
          $this->email = strip_tags($email);
          $this->sujet = strip_tags($sujet);
          $this->message = strip_tags($message);

     // rajout pour récupérer toutes les informations dans le corps du mail

 $this->message ="Nouveau message de : <strong>". $this->nom .'</strong><br>';
 $this->message .="Email : <em>".$this->email.'</em><br>';
 $this->message .="Sujet : <em>".$this->sujet.'</em><br>Message :';
 $this ->message .= strip_tags($message);

//suite fabrication du message    

          $this->headers = 'De : ' . $this->email . "\r\n"; // retour à la ligne
          $this->headers .= 'MIME-version: 1.0' . "\r\n";
          $this->headers .= 'Content-type : text/html; charset=utf-8' . "\r\n";

          // enfin, on utilise la fonction prédéfinie mail() de PHP
          mail($this->to, $this->sujet, $this->message, $this->headers);
     }
}

