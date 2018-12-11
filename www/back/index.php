<?php require 'inc/connexion.php';

include 'inc/connexion_user.php';

include 'inc/doc1.php'; ?>

<title>BACK OFFICE : TAREK CV : ACCUEIL</title>

<?php include 'inc/head2.php';
include 'inc/header3.php';?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase text-white">
              bonjour
            </h1>
            <hr>
            <strong class="text-white" style="font-size : 4em"> Je suis <?php echo $ligne_utilisateur['prenom']; ?> <?php echo $ligne_utilisateur['nom']; ?> </strong>
            <br>
            <span class="text-white">pseudo : <?php echo $ligne_utilisateur['pseudo']; ?></span>
       </div>
    </div>

    </div>
</header>
<?php include 'inc/contact4.php'; ?>