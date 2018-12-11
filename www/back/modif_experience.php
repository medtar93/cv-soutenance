<?php require 'inc/connexion.php';
include 'inc/connexion_user.php';

// gestion MAJ d'une info
if(isset($_POST['titre_exp'])){
    
    if( $_POST['titre_exp']!='' && $_POST['stitre_exp']!='' && $_POST['dates_exp']!='' && $_POST['description_exp'])
        {
            $titre_exp = addslashes($_POST['titre_exp']);
            $stitre_exp = addslashes($_POST['stitre_exp']);
            $dates_exp = addslashes($_POST['dates_exp']);
            $description_exp = addslashes($_POST['description_exp']);
            $id_experience = $_POST['id_experience'];

            $pdoCV->exec("UPDATE t_experiences SET titre_exp='$titre_exp', stitre_exp='$stitre_exp',dates_exp='$dates_exp', description_exp='$description_exp'  WHERE id_experience='$id_experience' ");
            header("location: ../back/experiences.php");
                exit();
            } //fin if
        } 

?>
<?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
<title>BACK OFFICE : TAREK CV - MES EXPERIENCES</title>
<?php
include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
    <h1 class="text-uppercase text-white">Mise à jour d'une experience</h1>
    <hr>
    <div class="text-white">
    <?php
    //Je recupère l'id de ce que je mets à jour 
    $id_experience = $_GET['id_experience']; // par son id et avec son get
    $sql = $pdoCV-> query("SELECT * FROM t_experiences WHERE id_experience='$id_experience'");
    $ligne_experience = $sql->fetch();
    ?>
    <h2><?php echo $ligne_experience['titre_exp'];?></h2>
    <ul>
        <li>id : <?php echo $ligne_experience['id_experience'];?></li>
        <li>expérience : <?php echo $ligne_experience['titre_exp'];?></li>
        <li>complément : <?php echo $ligne_experience['stitre_exp'];?></li>
        <li>dates: <?php echo $ligne_experience['dates_exp'];?> </li>
        <li>description : <?php echo $ligne_experience['description_exp'];?> </li>
    </ul>
    </div>
    <br> <br>
    <div class="btn btn-primary btn-xl js-scroll-trigger">
    <a href="#modifexperience" class="text-white">MODIFIER<i class="fas fa-pencil-alt ml-3"></i></a>
    </div>
</header>
<hr>
<form id="modifexperience" action="modif_experience.php" method="post">
        <div class="form-group mx-auto">
            <label for="titre_exp">expérience</label>
            <input type="text" name="titre_exp" placeholder="nouvelle experience" value="<?php echo $ligne_experience['titre_exp'];?>"   class="form-control"  required>
       </div>
       <div class="form-group mx-auto">
            <label for="stitre_exp">complément</label>
            <input type="text" name="stitre_exp" placeholder="complément" value="<?php echo $ligne_experience['stitre_exp'];?>" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="dates_exp">dates</label>
            <input type="text" name="dates_exp" placeholder="dates" value="<?php echo $ligne_experience['dates_exp'];?>"  class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="description_exp">description</label>
            <textarea  type="text" name="description_exp" placeholder="description" class="form-control" required><?php echo $ligne_experience['description_exp'];?></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description_exp' );
            </script>
       </div>
   

   <div class="">
   <input type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience'];?>" >
   <button type="submit" class="mx-auto btn btn-primary btn-xl js-scroll-trigger">Mettre à jour</button>
   </div>
</form>
    
    
</body>
</html>