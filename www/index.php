<?php require 'inc/connexion.php'; ?>

<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="site portfolio">
    <meta name="author" content="MOHAMMED-TAREK BENKHEROUF">
    <?php
    // Récupère les données de l'utilisateur par son id
    $sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = 1");
    $ligne_utilisateur = $sql-> fetch(); 
    ?>
    <title><?php echo $ligne_utilisateur['prenom'] . ' ' .$ligne_utilisateur['nom']; ?> : développeur web</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.min.css" rel="stylesheet">
    <!-- style for animation of #skills  -->
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">mtbenkherouf</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profil.png" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Qui suis je ?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#skills">Compétences</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#experience">Expériences</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#education">Formations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#interests">Loisirs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="contact.php">contact</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
        <div class="my-auto">
          <h1 class="mb-0"><?php echo $ligne_utilisateur['prenom']?>
            <span class="text-primary"><?php echo $ligne_utilisateur['nom']?></span>
          </h1>
          <div class="subheading mb-5">PARIS · Île-de-France· <?php echo $ligne_utilisateur['portable']; ?> · <?php echo $ligne_utilisateur['mail']; ?>
          </div>
          <h2>Développeur / intégrateur Web</h2>
          <p class="mb-5"><?php echo $ligne_utilisateur['description']; ?></p>
          <ul class="list-inline list-social-icons mb-0">
            <li class="list-inline-item">
              <a href="https://www.linkedin.com/in/mohammed-tarek-benkherouf" target="_blank">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://github.com/medtar93" target="_blank">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
        </div>
      </section>


      <!-- Compétences -->
      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="skills">
        <div class="my-auto">
        <?php   
              // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_competences");
            $sql -> execute();
          
            ?>
          <h2 class="mb-5">Compétences</h2><span>
         

          <section class="row rowcomp"> 
              <?php 
                  while($ligne_competence = $sql -> fetch()) {
              ?>
                <div class="col-lg-2 col-md-4 col-sm-6">

                    <h4 class="competence"></h4>
                    <svg class="radial-progress" data-percentage="<?= $ligne_competence['niveau']; ?>" viewBox="0 0 80 80">
                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 167.13272917097697;"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?= $ligne_competence['competence']; ?></text>
                    </svg> 
                    
                </div>
              <?php 
                  } // Fin de la boucle while
              ?>

          </section>

        </div>
      </section><!-- fin compétence -->  
      <!-- EXPERIENCE -->
      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience">
        <div class="my-auto">
          
          <?php   
              // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_experiences $order");
            $sql -> execute();
          ?> 
          <h2 class="mb-5">Expériences</h2>
          
         <div class="resume-item d-flex flex-column flex-md-row mb-5">
          <?php while ($ligne_experience=$sql->fetch())
                     {
            ?>
          
            <div class="resume-content mr-auto col-lg-4">
              <h3 class="mb-0"><?php echo $ligne_experience['titre_exp'];?></h3>
              <span class="text-primary"><?php echo $ligne_experience['dates_exp'];  ?></span>
              <div class="subheading mb-3"><?php echo $ligne_experience['stitre_exp'];  ?></div>
              <?php echo $ligne_experience['description_exp'];  ?>
            </div>
          
          <?php } ?>
          </div>

        </div>

      </section><!-- fin expérience -->

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="education">
        <div class="my-auto">
            <?php   
              // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la requête
            $sql = $pdoCV -> prepare("SELECT * FROM t_formations $order");
            $sql -> execute();
            $nbr_formations = $sql -> rowCount();
            ?>
          <h2 class="mb-3 ">Formations</h2> 
          <div class="resume-item d-flex flex-column flex-md-row row mb-5">
          <?php while ($ligne_formation=$sql->fetch())
              {
          ?>
            <div class="resume-content mr-auto col-lg-4 col-md-12 mb-5">
              <h3><?php echo $ligne_formation['titre_form'];  ?></h3>
              <span class="text-primary"><?php echo $ligne_formation['dates_form'];  ?></span>
              <div class="subheading"><p><?php echo $ligne_formation['stitre_form'];  ?></p></div>
              <div><?php echo $ligne_formation['description_form'];  ?></div>
            </div>
            <?php } ?>
          </div>
        </div>
          
          
          
          <div class="resume-item d-flex flex-column flex-md-row mb-5">
           

         
        </div>
      </section>

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="interests">
        <div class="my-auto">
        <?php
        // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparé (avec : prepare) la rrequête
        $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");
        $sql -> execute();
        $nbr_loisirs = $sql -> rowCount();
        ?>
          <h2 class="mb-5">loisirs</h2>
          <table class="table table-striped table-bordered bg-light" style="width:100%">
            
            <tbody>
                <?php while ($ligne_loisir=$sql->fetch())
                    {
                ?>
                <tr>
                    <td><?php echo $ligne_loisir['loisir'];  ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
      </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script> 
    <script src="js/animate.js"></script>
    <script src="js/animate2.js"></script>
    <!-- Script JavaScript du formulaire de contact -->
    <script src="js/scripts.js"></script>
    <script src="js/validator.min.js"></script>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

  </body>

</html>
