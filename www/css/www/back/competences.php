<?php require 'inc/connexion.php';
    include 'inc/connexion_user.php';
?>
<?php
if(isset($_POST['competence'])  )
{// si on a reçu une nouvelle compétence 
    if( $_POST['competence']!='' && $_POST['niveau']!='' && $_POST['categorie']!='') {
        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);

        $pdoCV->exec("INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1')");

        header("location: ../back/competences.php");
            exit();}
    } //fin if

     //suppression d'une competence de la BDD
if(isset($_GET['id_competence'])){ // on recupère la compétence dans l'url par son id 
    
    $efface = $_GET['id_competence']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_competences WHERE id_competence = '$efface' ";//delete de la base 
    $pdoCV->query($sql);// on peut le faire avec exec également 

    header("location: ../back/competences.php");
    exit();
    }
     // pour pouvoir trier les infos 
     $order = '';
     if(isset($_GET['order']) && isset($_GET['column'])){
 
        if($_GET['column'] == 'competence'){$order = ' ORDER BY competence';}
            elseif($_GET['column'] == 'niveau'){$order = ' ORDER BY niveau';}
            elseif($_GET['column'] == 'categorie'){$order = ' ORDER BY categorie';}
        if($_GET['order'] == 'asc'){$order.= ' ASC';}
            elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
    }
 ?>
<?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
<title>BACK OFFICE : TAREK CV - MES COMPETENCES</title>
<?php
include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head 
  include 'inc/header3.php'; ?>
  
          <div class="container">
            
            <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase text-white">
              <strong>Mes compétences</strong>
            </h1>
            <hr>
           </div>
          
             <?php   
              // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_competences $order");
            $sql -> execute();
            $nbr_competences = $sql -> rowCount();
            ?>
           <div class="row">
                <table class="table table-fixed bg-light">
                <thead>
                    <tr>
                        <th class="col-6"><?php echo $nbr_competences;?> compétences 
                            <a href="competences.php?column=competence&order=asc"><i class="fas fa-sort-alpha-down"></i></a> |
                            <a href="competences.php?column=competence&order=desc"><i class="fas fa-sort-alpha-up"></i></a> </th>
                        <th class="col-3">
                            catégorie
                        <a href="competences.php?column=categorie&order=desc"><i class="fas fa-sort-alpha-down"></i></a> |
                        <a href="competences.php?column=categorie&order=asc"><i class="fas fa-sort-alpha-up"></i></a>
                        </th>
                        <th class="col-1">
                            niveau
                            <a href="competences.php?column=niveau&order=asc"><i class="fas fa-sort-numeric-down"></i></a> | 
                            <a href="competences.php?column=niveau&order=desc"><i class="fas fa-sort-numeric-up"></i></a>
                        </th>
                        <th class="col-1">modifier <br></th>
                        <th class="col-1">supprimer <br></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($ligne_competence=$sql->fetch())
                     {
                ?>
                    <tr>
                        <td class="col-6"><?php echo $ligne_competence['competence'];  ?></td>
                        <td class="col-3"><?php echo $ligne_competence['categorie'];  ?></td>
                        <td class="col-1"><?php echo $ligne_competence['niveau'];  ?></td>
                        <td class="col-1"><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence'];?>"><i class="fas fa-pencil-alt"></i></a></td>
                        <td  class="col-1"><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence'];?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
                <a href="#formulaire">Ajouter une compétence</a>
            </div>
         </div>
     </div> 
    </header>
      
        
  <br> <br>


<div id="formulaire">
    <hr>
    <div class="container mx-auto">
        <h2 class="text-uppercase text-dark mx-auto">
            <strong>Insérer une formation</strong>
        </h2>
        <br>
    </div>
    <form action="competences.php" method="post">
       <div class="form-group mx-auto">
            <label for="competence">competence</label>
            <input type="text" name="competence" placeholder="nouvelle competence" class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="niveau">niveau</label>
            <input type="text" name="niveau" placeholder="niveau de 1 à 5"  class="form-control" required>
       </div>
       <div class="form-group mx-auto">
            <label for="categorie">catégorie</label>
            <select name="categorie" id="" class="form-control"  >
                <option value="Développement">Développement</option>
                <option value="Infographie">Infographie</option>
                <option value="Gestion de projet">Gestion de projet</option>
            
            </select>
       </div>
    
       <div class="form-group mx-auto">
       <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">Insérer une compétences</button>
       </div>
    </form>
</div>

<?php include 'inc/contact4.php'; ?>


