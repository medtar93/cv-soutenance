<?php 

// on récupère la classe Contact 
require('Contact.class.php');

//on vérifie l'envoie du formulaire 
if(!empty($_POST)){
    // avec extract() on accède directement aux champs par leurs noms en variable 
    extract($_POST);

    // on valide les données saisies
        // 1 - champs renseignés et email valide
        $valid = (empty($nom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($sujet) || empty($message)) ? false : true;

        // 2 - validation des champs
    $erreurnom = (empty($nom)) ? 'Indiquez votre nom.' : null;
    $erreuremail = (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) ? 'Entrez un mail valide, merci.' : null;
    $erreursujet = (empty($sujet)) ? 'L\'objet de votre mail.' : null;
    $erreurmessage = (empty($message)) ? 'Ecrivez votre message.' : null;

    /* 
    /!\ Effectuer toutes les vérifications de formulaire ici => strlen($nom) > 5 || strlen($nom) < 100 ...
    */

    // si le formulaire est validé
    if($valid) {
        // on instancie un objet de la classe Contact
        $contact = new Contact;

        // on réalise l'insertion en BDD avec la méthode insertContact()
        
        $contact->insertContact($nom, $email, $sujet, $message);

    // on appelle la méthode sendEmail()
     $contact->sendEmail($nom, $sujet, $email, $message); // ne fonctionne pas sur localhost sans un paramétrage spécial

        // on efface les valeurs du formulaire (évite un envoi multiple)
        unset($nom);
        unset($sujet);
        unset($email);
        unset($message);
        unset($contact);

        // on crée une variable d'affichage de succès de l'envoi du formulaire
        $success = 'Message bien envoyé !';
    }
}

?>

        <div id="content" class="container">
            <div class="card">
                <div class="card-body">
                    <!-- BONUS EMAIL -->
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success" role="alert"><?= $success; ?></div>
                    <?php endif ?>
                    <!-- FIN BONUS EMAIL -->
                    <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <span class="error"><?php if (isset($erreurnom)) echo $erreurnom; ?></span>
                            <input class="form-control" type="text" name="nom" value="<?php if (isset($nom)) echo $nom; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <span class="error"><?php if (isset($erreuremail)) echo $erreuremail; ?></span>
                            <input class="form-control" type="text" name="email" value="<?php if (isset($email)) echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="sujet">Sujet :</label>
                            <span class="error"><?php if (isset($erreursujet)) echo $erreursujet; ?></span>
                            <input class="form-control" type="text" name="sujet" value="<?php if (isset($sujet)) echo $sujet; ?>">
                        </div>
                        <div class="form-group">
                            <label for="message">Message :</label>
                            <span class="error"><?php if (isset($erreurmessage)) echo $erreurmessage; ?></span>
                            <textarea class="form-control" name="message" cols="30" rows="10"><?php if (isset($message)) echo $message; ?></textarea>
                        </div>

                        <input type="submit" class="submit btn btn-success float-md-right " value="Envoyer" />

                    </form>
                </div>
            </div>
        </div><!-- /.container -->

        <!-- JS for Bootstrap -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
   