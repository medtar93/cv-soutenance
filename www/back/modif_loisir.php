<?php require 'inc/connexion.php';
include 'inc/connexion_user.php';

// gestion MAJ d'une info
if(isset ($_POST['loisir'])){// si on areçu un nouveau loisir 
   
    $loisir = addslashes($_POST['loisir']);
    $id_loisir = $_POST['id_loisir'];
   
    $pdoCV->exec("UPDATE t_loisirs SET loisir='$loisir' WHERE id_loisir='$id_loisir'");

    header("location: ../back/loisirs.php");
        exit();
    } //fin if

//Je recupère l'id de ce que je mets à jour 
$id_loisir=$_GET['id_loisir']; // par son id et avec son get
$sql = $pdoCV-> query("SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir'");
$ligne_loisir = $sql->fetch(); //va chercher! va!


include 'inc/doc1.php';
?>
<title>BACK OFFICE : TAREK CV - MODIFIER LOISIR</title>
<?php include 'inc/head2.php';
include 'inc/header3.php';
?>

    <div class="text-white">
        <h1 class="text-uppercase ">Mise à jour d'un loisir</h1>
        <hr>
        <span style="font-size: 2em"><?php echo $ligne_loisir['loisir'];?></span>
    </div>

    <br> <br>
    <div class="btn btn-primary btn-xl js-scroll-trigger">
    <a href="#majloisir" class="text-white text-uppercase">mettre à jour<i class="fas fa-pencil-alt ml-3"></i></a>
    </div>
</header>
<hr>
<form id="majloisir" action="modif_loisir.php" method="post" class="ml-5">
   <div class="mb-2 form-group mx-auto">
        <label for="loisir">Loisir</label>
        <input type="text" name="loisir" value="<?php echo $ligne_loisir['loisir'];?>" placeholder="nouveau loisir" class="form-control" required>
   </div>

   <div class="mb-5 form-group mx-auto">
   <input type="hidden" name="id_loisir" value="<?php echo $ligne_loisir['id_loisir'];?>" >
   <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">mettre à jour</button>
   </div>
</form>
    
    
</body>
</html>