<?php
     require 'inc/connexion.php';
     include 'inc/connexion_user.php';
?>
<?php
//insertion d'un loisir 
if(isset($_POST['loisir']) && $_POST['loisir']!='' ){// si on areçu un nouveau loisir 
    $loisir = addslashes($_POST['loisir']);
    $pdoCV->exec("INSERT INTO t_loisirs VALUES (NULL, '$loisir','1')");

    header("location: ../back/loisirs.php");
        exit();
    } //fin if

    //suppression d'un loisir de la BDD
if(isset($_GET['id_loisir'])){ // on recupère le loisir dans l'url par son id 
    
    $efface = $_GET['id_loisir']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";//delete de la base 
    $pdoCV->query($sql);// on peut le faire avec exec également 

    header("location: ../back/loisirs.php");
    exit();

}
?>
<?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
 
    <?php include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
<?php

       // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête

       $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");

       $sql -> execute();

       $nbr_loisirs = $sql -> rowCount();

   ?>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h1 class="text-uppercase text-white">
                    <strong>Mes loisirs</strong>
                </h1>
                <hr>
            </div>
        </div>
    <div class="container">
        <table class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>Loisirs: <?php echo $nbr_loisirs; ?></th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ligne_loisir=$sql->fetch())
                    {
                ?>
                <tr>
                    <td><?php echo $ligne_loisir['loisir'];  ?></td>
                    <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>"><i class="fas fa-pencil-alt"></i></a></td>
                    <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <span><a href="#formloisir">Ajouter un nouveau loisir</a></span>
    </div>
    </header>
    </div> 
    <hr> <!-- formulaire d'ajout-->
    <div class="container row" id="formloisir">

            <div class="col-lg-8 mx-auto">
                <h2 class="text-uppercase text-dark">
                    <strong>Insérer un loisir</strong>
                </h2>
               <br>
            <form action="loisirs.php" method="post">
            <div class="form-group mx-auto">
                    <label for="loisir">Loisir</label>
                    <input type="text" name="loisir" placeholder="nouveau loisir" class="form-control" required>
            </div>

            <div class="form-group mx-auto">
            <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">Insérer une compétences</button>
            </div>
            </form>
            <br>
            </div>

    </div>
     <?php include 'inc/contact4.php'; ?>
    