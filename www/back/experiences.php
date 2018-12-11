<?php require 'inc/connexion.php';
include 'inc/connexion_user.php';
 ?>
<?php
if(isset($_POST['titre_exp'])  )
{// si on areçu une nouvelle experience 
    if( $_POST['titre_exp']!='' && $_POST['stitre_exp']!='' && $_POST['dates_exp']!='' && $_POST['description_exp']!='') {
        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);

        $pdoCV->exec("INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1')");

        header("location: ../back/experiences.php");
            exit();}
    } //fin if
     //suppression d'une experience de la BDD
if(isset($_GET['id_experience'])){ // on recupère l'expérience dans l'url par son id 
    
    $efface = $_GET['id_experience']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_experiences WHERE id_experience = '$efface' ";//delete de la base 
    $pdoCV->query($sql);// on peut le faire avec exec également 

    header("location: ../back/experiences.php");
    exit();
    }
     // pour pouvoir trier les infos 
     $order = '';
     if(isset($_GET['order']) && isset($_GET['column'])){
 
   if($_GET['column'] == 'titre_exp'){$order = ' ORDER BY titre_exp';}
   elseif($_GET['column'] == 'stitre_exp'){$order = ' ORDER BY stitre_exp';}
   elseif($_GET['column'] == 'dates_exp'){$order = ' ORDER BY dates_exp';}
   if($_GET['order'] == 'asc'){$order.= ' ASC';}
   elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
  }
 ?>
 <?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
<title>BACK OFFICE : TAREK CV - MES EXPERIENCES</title>

<?php include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
        <div class="container">
            <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase text-white">
              <strong>Mes expériences</strong>
            </h1>
            <hr>
           </div>
           <br><br>
             <?php   
              // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_experiences $order");
            $sql -> execute();
            $nbr_experiences = $sql -> rowCount();
            ?> 
            <div class="table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                <table  class="table table-striped table-bordered bg-light" style="width:100%" >
                    <thead>
                        <tr>
                            <th><?php echo $nbr_experiences;?> expériences<br>
                            <a href="experiences.php?column=titre_exp&order=asc"><i class="fas fa-sort-alpha-down"></i></a> |
                            <a href="experiences.php?column=titre_exp&order=desc"><i class="fas fa-sort-alpha-up"></i></a> 
                            </th>
                            <th>complément<br>
                            <a href="experiences.php?column=stitre_exp&order=asc"><i class="fas fa-sort-alpha-down"></i></a> |
                            <a href="experiences.php?column=stitre_exp&order=desc"><i class="fas fa-sort-alpha-up"></i></a>
                            </th>
                            <th>dates<br>
                                <a href="experiences.php?column=dates_exp&order=asc"><i class="fas fa-sort-numeric-down"></i></a> | 
                                <a href="experiences.php?column=dates_exp&order=desc"><i class="fas fa-sort-numeric-up"></i></a>
                            </th>
                            <th>description </th><br>
                            <th>modifier <br></th>
                            <th>supprimer <br></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($ligne_experience=$sql->fetch())
                            {
                        ?>
                        <tr>
                            <td><?php echo $ligne_experience['titre_exp'];  ?></td>
                            <td><?php echo $ligne_experience['stitre_exp'];  ?></td>
                            <td><?php echo $ligne_experience['dates_exp'];  ?></td>
                            <td><?php echo $ligne_experience['description_exp'];  ?></td>
                            <td><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience'];?>"><i class="fas fa-pencil-alt"></i></a></td>
                            <td><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience'];?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <a href="#formulaire">Ajouter une experience</a>
    </div>
    </div>
    </div>
</header>
<hr>
<div id="formulaire">
    <div class="col-lg-10 mx-auto">
        <h2 class="text-uppercase text-dark">
            <strong>Insérer une expérience</strong>
        </h2>
        <br>
    </div>

    <form action="experiences.php" method="post">
       <div class="form-group mx-auto">
            <label for="titre_exp">expérience</label>
            <input type="text" name="titre_exp" placeholder="nouvelle experience" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="stitre_exp">complément</label>
            <input type="text" name="stitre_exp" placeholder="complément" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="dates_exp">dates</label>
            <input type="text" name="dates_exp" placeholder="dates" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="description_exp">description</label>
            <textarea  type="text" name="description_exp" id="description_exp" placeholder="description" class="form-control" required></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description_exp' );
            </script>
       </div>
                        
       <br>
       <div class="form-group mx-auto">
       <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">Insérer une expérience</button>
       </div>
    </form>
</div>
     
<?php include 'inc/contact4.php'; ?>