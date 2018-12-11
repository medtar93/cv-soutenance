
    <div id="contact" class="footer container-fluid text-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center ">
            <h2 class="section-heading">ME CONTACTER</h2>
            <hr class="my-4">
            <p class="mb-5">Pour plus d'information sur mon profil, je vous invite à me contacter <br> par <a href="#telephone" title="<?php echo $ligne_utilisateur['portable']; ?>">téléphone</a> ou par <a href="#mail" title="<?php echo $ligne_utilisateur['email']; ?>">email</a></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center text-light">
            <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
            <p class="text-light" id="telephone"><?php echo $ligne_utilisateur['portable']; ?></p>
          </div>
          <div class="col-lg-4 mr-auto text-center ">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
            <p id="mail">
              <a href="mailto:your-email@your-domain.com"><?php echo $ligne_utilisateur['email']; ?></a>
            </p>
          </div>
        </div>
      </div>
    </div>

        <!-- Bootstrap core JavaScript -->
    <script src="../startbootstrap-creative-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="../startbootstrap-creative-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../startbootstrap-creative-gh-pages/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../startbootstrap-creative-gh-pages/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../startbootstrap-creative-gh-pages/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>
</body>
</html>