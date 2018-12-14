<?php require 'inc/connexion.php';
include 'inc/connexion_user.php';

// gestion MAJ d'une info
if(isset($_POST['titre_form'])){
    
    if( $_POST['titre_form']!='' && $_POST['stitre_form']!='' && $_POST['dates_form']!='' && $_POST['description_form'])
        {
            $titre_form = addslashes($_POST['titre_form']);
            $stitre_form = addslashes($_POST['stitre_form']);
            $dates_form = addslashes($_POST['dates_form']);
            $description_form = addslashes($_POST['description_form']);
            $id_formerience = $_POST['id_formation'];

            $pdoCV->exec("UPDATE t_formations SET titre_form='$titre_form', stitre_form='$stitre_form',dates_form='$dates_form', description_form='$description_form'  WHERE id_formation='$id_formation' ");
            header("location: ../back/formations.php");
                exit();
            } //fin if
        } 

?>
<?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
<title>BACK OFFICE : TAREK CV - MISE A JOUR FORMATION</title>
<?php
include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
    <h1 class="text-uppercase text-white">Mise à jour d'une formation</h1>
    <hr>
    <div class="text-white">
    <?php
    //Je recupère l'id de ce que je mets à jour 
    $id_formation = $_GET['id_formation']; // par son id et avec son get
    $sql = $pdoCV-> query("SELECT * FROM t_formations WHERE id_formation='$id_formation'");
    $ligne_formation = $sql->fetch();
    ?>
    <h2><?php echo $ligne_formation['titre_form'];?></h2>
    <ul>
        <li>id : <?php echo $ligne_formation['id_formation'];?></li>
        <li>formation : <?php echo $ligne_formation['titre_form'];?></li>
        <li>complément : <?php echo $ligne_formation['stitre_form'];?></li>
        <li>dates: <?php echo $ligne_formation['dates_form'];?> </li>
        <li>description : <?php echo $ligne_formation['description_form'];?> </li>
    </ul>
    </div>
    <br> <br>
    <div class="btn btn-primary btn-xl js-scroll-trigger">
    <a href="#modifformation" class="text-white">MODIFIER<i class="fas fa-pencil-alt ml-3"></i></a>
    </div>
</header>
<hr>
<form id="modifformation" action="modif_formation.php" method="post">
        <div class="form-group mx-auto">
            <label for="titre_form">formation</label>
            <input type="text" name="titre_form" placeholder="nouvelle formation" class="form-control" value="<?php echo $ligne_formation['titre_form'];?>" required>
       </div>
       <div class="form-group mx-auto">
            <label for="stitre_form">complément</label>
            <input type="text" name="stitre_form" placeholder="complément" class="form-control" value="<?php echo $ligne_formation['stitre_form'];?>"required>
       </div>
       <div class="form-group mx-auto">
            <label for="dates_form">dates</label>
            <input type="text" name="dates_form" placeholder="dates" class="form-control" value="<?php echo $ligne_formation['dates_form'];?>" required>
       </div>
       <div class="form-group mx-auto">
            <label for="description_form">description</label>
            <textarea  type="text" name="description_form" placeholder="description" class="form-control" required><?php echo $ligne_formation['description_form'];?></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description_form' );
            </script>
       </div>
   

   <div class="">
   <input type="hidden" name="id_formation" value="<?php echo $ligne_formation['id_formation'];?>" >
   <button type="submit" class="text-uppercase btn btn-primary btn-xl js-scroll-trigger">mettre à jour</button>
   </div>
</form>
    
    
</body>
</html>