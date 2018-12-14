<?php require 'inc/connexion.php';

// gestion MAJ d'une info
if(isset($_POST['competence'])){
    
    if( $_POST['competence']!='' && $_POST['niveau']!='' && $_POST['categorie']!='')
        {
            $competence = addslashes($_POST['competence']);
            $niveau = addslashes($_POST['niveau']);
            $categorie = addslashes($_POST['categorie']);
            $id_competence = $_POST['id_competence'];

            $pdoCV->exec("UPDATE t_competences SET competence='$competence', niveau='$niveau',categorie='$categorie'  WHERE id_competence='$id_competence' ");
            header("location: ../back/competences.php");
                exit();
            } //fin if
        } 

?>
<?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
<title>BACK OFFICE : TAREK CV - MES COMPETENCES</title>
<?php
include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
    <h1 class="text-uppercase text-white">Mise à jour d'une competence</h1>
    <hr>
    <div class="text-white">
    <?php
    //Je recupère l'id de ce que je mets à jour 
    $id_competence = $_GET['id_competence']; // par son id et avec son get
    $sql = $pdoCV-> query("SELECT * FROM t_competences WHERE id_competence='$id_competence'");
    $ligne_competence = $sql->fetch();
    ?>
    <h2><?php echo $ligne_competence['competence'];?></h2>
    <ul>
        <li>id : <?php echo $ligne_competence['id_competence'];?></li>
        <li> niveau : <?php echo $ligne_competence['niveau'];?>/ 5</li>
        <li>catégorie : <?php echo $ligne_competence['categorie'];?> </li>
    </ul>
    </div>
    <br> <br>
    <div class="btn btn-primary btn-xl js-scroll-trigger">
    <a href="#modifcompetence" class="text-white">MODIFIER<i class="fas fa-pencil-alt ml-3"></i></a>
    </div>
</header>
<hr>
<form id="modifcompetence" action="modif_competence.php" method="post">
   <div class="form-group mx-auto">
        <label for="competence">compétence</label>
        <input type="text" name="competence" placeholder="nouvelle competence"  class="form-control"  value="<?php echo $ligne_competence['competence'];?>" required>
   </div>
   <div class="form-group mx-auto">
        <label for="niveau">niveau</label>
        <input type="text" name="niveau" placeholder="niveau de 1 à 5"  class="form-control"  value="<?php echo $ligne_competence['niveau'];?>" required>
   </div>
   <div class="form-group mx-auto">
        <label for="categorie">catégorie</label>
        <select name="categorie" id=""  class="form-control">
            <option value="Développement" <?php 
            if(!(strcmp("Développement", $ligne_competence['categorie']))) {
                 echo "selected=\"selected\"";
                }  
            ?>>Développement</option>
            <option value="Infographie" <?php 
            if(!(strcmp("Infographie", $ligne_competence['categorie']))) { 
                echo "selected=\"selected\"";
                }  
            ?>>Infographie</option>
            <option value="Gestion de projet" <?php 
            if(!(strcmp("Gestion de projet", $ligne_competence['categorie']))) 
            { echo "selected=\"selected\"";
              }  
            ?>>Gestion de projet</option>
        
        </select>
   </div>

   <div class="form-group mx-auto">
   <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence'];?>" >
   <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger text-uppercase">mettre à jour</button>
   </div>
</form>
    
    
</body>
</html>