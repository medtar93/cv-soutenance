<?php
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/
// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
$destinataire = 'contact@mtbenkherouf.com';

// copie ? (envoie une copie au visiteur)
$copie = 'oui';

// Action du formulaire (si votre page a des paramètres dans l'URL)
// si cette page est index.php?page=contact alors mettez index.php?page=contact
// sinon, laissez vide
$form_action = '';

// Messages de confirmation du mail
$message_envoye = "Votre message a été envoyé avec succés !";
$message_non_envoye = "L'envoi de votre message a échoué, veuillez réessayer SVP.";

// Message d'erreur du formulaire
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

/*
	********************************************************************************************
	FIN DE LA CONFIGURATION
	********************************************************************************************
*/

/*
 * cette fonction sert à nettoyer et enregistrer un texte
 */
function Rec($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}

	$text = nl2br($text);
	return $text;
};

/*
 * Cette fonction sert à vérifier la syntaxe d'un email
 */
function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

// formulaire envoyé, on récupère tous les champs.
$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

$name = $ligne_utilisateur['nom'];
$prenom = $ligne_utilisateur['prenom'];
$email2 = $ligne_utilisateur['email'];
$portable = $ligne_utilisateur['portable'];


// On va vérifier les variables et l'email ...
$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

if (isset($_POST['envoi']))
{
	if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
	{
		// les variables sont remplies, on génère puis envoie le mail
		$headers  = 'From:'.$nom.' <'.$email.'>' . "\r\n";
		$headers .= 'Reply-To: '.$email. "\r\n" ;
		$headers .= 'MIME-version: 1.0\r\n';
		$headers .= 'X-Mailer:PHP/'.phpversion();
		$headers .= 'Content-Type: text/html; charset=\"UTF-8'."\n"; // permet d'avoir les accents et du html dans le mail 
		$headers .= 'Content-Transfer-Encoding: 8bit';

		// envoyer une copie au visiteur ?
		if ($copie == 'oui')
		{
			$cible = $destinataire.';'.$email;
		}
		else
		{
			$cible = $destinataire;
		};

		// Remplacement de certains caractères spéciaux
		// $message = str_replace("&#039;","'",$message);
		// $message = str_replace("&#8217;","'",$message);
		// $message = str_replace("&quot;",'"',$message);
		// $message = str_replace('&lt;br&gt;','',$message);
		// $message = str_replace('&lt;br /&gt;','',$message);
		// $message = str_replace("&lt;","&lt;",$message);
		// $message = str_replace("&gt;","&gt;",$message);
		// $message = str_replace("&amp;","&",$message);

		// Envoi du mail
		$num_emails = 0;
		$tmp = explode(';', $cible);
		foreach($tmp as $email_destinataire)
		{
			if (mail($email_destinataire, $objet, $message, $headers))
				$num_emails++;
		}

		if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
		{
			echo '<p class="text-success">'.$message_envoye.'</p>';
		}
		else
		{
			echo '<p class="text-warning">'.$message_non_envoye.'</p>';
		};
	}
	else
	{
		// une des 3 variables (ou plus) est vide ...
		echo '<p>'.$message_formulaire_invalide.'</p>';
		$err_formulaire = true;
	};
}; // fin du if (!isset($_POST['envoi']))

if (($err_formulaire) || (!isset($_POST['envoi'])))
{
	// afficher le formulaire
	echo '
      <form id="contact" method="post" action="'.$form_action.'">
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" class="form-control" name="nom" value="'.stripslashes($nom).'" tabindex="1" />
            </div><!--/.form-group-->
          </div><!--/.col-->
          <div class="col-sm-6 col-xs-12">
            <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" class="form-control" name="email" value="'.stripslashes($email).'" tabindex="2" />
            </div><!--/.form-group-->
          </div><!--/.col-->
        </div><!--/.row-->
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
            <label for="objet">Objet</label>
            <input type="text" id="objet" class="form-control" name="objet" value="'.stripslashes($objet).'" tabindex="3" />
            </div><!--/.form-group-->
          </div><!--/.col-->
        </div><!--/.row-->
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" class="form-control" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea>
            </div><!--/.form-group-->
          </div><!--/.col-->
        </div><!--/.row-->
        <div class="row">
          <div class="col-sm-12">
						<div class="single-contact-btn">
            <input type="submit" name="envoi" class="btn btn-success float-md-right" value="Envoyer" />
            </div><!--/.single-single-contact-btn-->
          </div><!--/.col-->
        </div><!--/.row-->
      </form><!--/form-->';
};

