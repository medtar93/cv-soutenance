    <?php require 'inc/connexion.php';
     session_start(); // permet de mettre dans toutes les pages l'admin.
     
    //taitement pour la connexion à l'admin 
    if(isset($_POST['connexion'])) {

        $email = addslashes($_POST['email']);
        $mdp = addslashes($_POST['mdp']);

        $sql = $pdoCV -> prepare (" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' "); // on verifie email Et mot de passe 
        $sql -> execute();
        $nbr_utilisateur = $sql -> rowCount();
        
        if($nbr_utilisateur == 0){
            //echo $nbr_utilisateur;
        }else{
            $ligne_utilisateur = $sql -> fetch();

            $_SESSION['connexion_admin']='connecté';
            $_SESSION['id_utilisateur']= $ligne_utilisateur['id_utilisateur'];
            $_SESSION['email']= $ligne_utilisateur['email'];
            $_SESSION['nom']= $ligne_utilisateur['nom'];
            $_SESSION['mdp']= $ligne_utilisateur['mdp'];

            header('location:index.php');
          //echo $ligne_utilisateur['nom'];

           
        }

    }
    
    
    ?>
    <?php include 'inc/doc1.php'; // debut de la page HTML (doctype + meta ) ?>
        <title>BACK OFFICE : TAREK CV : AUTHENTIFICATION</title>
     <?php include 'inc/head2.php'; // inclusion du headend.php qui contient tout les liens CDN nécéssaires et la femeture de la balise head ?> 
    <body id="page-top">
        <header class="masthead text-center text-light d-flex">
            <div class="container my-auto">
                <h1>Admin: mtbenkherouf.com </h1>
                <form action="authentification.php" method="post">
                    <div class="form-group mx-auto">
                        <label for="email">email</label>
                        <input type="email" name="email" placeholder="coucou@coucou.com" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group mx-auto">
                        <label for="mdp"> mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="votre mot de passe">
                    </div>
                    <br><br>
                    <button type="submit" name="connexion" class="btn btn-primary btn-xl js-scroll-trigger">se connecter</button>
                </form>
            </div>
    </header>
</body>
</html>