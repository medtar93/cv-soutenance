<?php require 'inc/connexion.php';
include 'inc/connexion_user.php';
?>
<?php
if(isset($_POST['titre_form'])  )
{// si on areçu une nouvelle formation 
    if( $_POST['titre_form']!='' && $_POST['stitre_form']!='' && $_POST['dates_form']!='' && $_POST['description_form']!='') {
        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);

        $pdoCV->exec("INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '1')");

        header("location: ../back/formations.php");
            exit();}
    } //fin if
     //suppression d'une formation de la BDD
if(isset($_GET['id_formation'])){ // on recupère la formation dans l'url par son id 
    
    $efface = $_GET['id_formation']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_formations WHERE id_formation = '$efface' ";//delete de la base 
    $pdoCV->query($sql);// on peut le faire avec exec également 

    header("location: ../back/formations.php");
    exit();
    }
     // pour pouvoir trier les infos 
     $order = '';
     if(isset($_GET['order']) && isset($_GET['column'])){
 
   if($_GET['column'] == 'titre_form'){$order = ' ORDER BY titre_form';}
   elseif($_GET['column'] == 'stitre_form'){$order = ' ORDER BY stitre_form';}
   elseif($_GET['column'] == 'dates_form'){$order = ' ORDER BY dates_form';}
   if($_GET['order'] == 'asc'){$order.= ' ASC';}
   elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
  }
 ?>
 <?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
<title>BACK OFFICE : TAREK CV - MES formationS</title>

<?php include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase text-white">
              <strong>Mes formations</strong>
            </h1>
            <hr>
       </div>
    </div>
             <?php   
              // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_formations $order");
            $sql -> execute();
            $nbr_formations = $sql -> rowCount();
            ?>
            <div class="table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                <table  class="table table-striped table-bordered bg-light" style="width:100%" >
                    <thead>
                        <tr>
                            <th><?php echo $nbr_formations;?> formations<br>
                            <a href="formations.php?column=titre_form&order=asc"><i class="fas fa-sort-alpha-down"></i></a> |
                            <a href="formations.php?column=titre_form&order=desc"><i class="fas fa-sort-alpha-up"></i></a> 
                            </th>
                            <th>complément<br>
                            <a href="formations.php?column=stitre_form&order=desc"><i class="fas fa-sort-alpha-down"></i></a> |
                            <a href="formations.php?column=stitre_form&order=asc"><i class="fas fa-sort-alpha-up"></i></a>
                            </th>
                            <th>dates<br>
                                <a href="formations.php?column=dates_form&order=asc"><i class="fas fa-sort-numeric-down"></i></a> | 
                                <a href="formations.php?column=dates_form&order=desc"><i class="fas fa-sort-numeric-up"></i></a>
                            </th>
                            <th>description </th><br>
                            <th>modifier <br></th>
                            <th>supprimer <br></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($ligne_formation=$sql->fetch())
                            {
                        ?>
                        <tr>
                            <td><?php echo $ligne_formation['titre_form'];  ?></td>
                            <td><?php echo $ligne_formation['stitre_form'];  ?></td>
                            <td><?php echo $ligne_formation['dates_form'];  ?></td>
                            <td><?php echo $ligne_formation['description_form'];  ?></td>
                            <td><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation'];?>"><i class="fas fa-pencil-alt"></i></a></td>
                            <td><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation'];?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <a href="#formulaire">Ajouter une formation</a>
    </div>
    </div>
    </div>
</header>
<br>
<div id="formulaire">
    <br>
   
    <hr>
    <div class="col-lg-10 mx-auto">
        <h2 class="text-uppercase text-dark">
            <strong>Insérer une formation</strong>
        </h2>
        <br>
    </div>

    <form action="formations.php" method="post">
       <div class="form-group mx-auto">
            <label for="titre_form">formation</label>
            <input type="text" name="titre_form" placeholder="nouvelle formation" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="stitre_form">complément</label>
            <input type="text" name="stitre_form" placeholder="complément" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="dates_form">dates</label>
            <input type="text" name="dates_form" placeholder="dates" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="description_form">description</label>
            <textarea type="text" name="description_form" placeholder="description" class="form-control" required></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description_form' );
            </script>
       </div>
                        
       <br>
       <div class="form-group mx-auto">
       <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">Insérer une formation</button>
       </div>
    </form>
</div>
     

<?php include 'inc/contact4.php'; ?>