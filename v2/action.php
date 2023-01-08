<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PhotoGallery - Gallery</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="top_menu">
  <ul class="menu">
    <li><a href="gallery.html" class="nav">gallery</a></li>
  </ul>
</div>
<div id="main_content">
  <div id="top_banner"> <a href="#"><img src="images/logo.jpg" width="230" height="130" alt="" border="0" class="logo" /></a> </div>
  <div id="page_content">
    <div class="title">
      <h2 style=text-align:center;>Confirmation inscription</h2>
    </div>
    <div id="contenu">
      <?php

      $mysqli = new mysqli('localhost','nom_utilisateur','mot_de_passe','nom_base');

      if ($mysqli->connect_errno)
       {
        // Affichage d'un message d'erreur
        echo "Error: Problème de connexion à la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        // Arrêt du chargement de la page
        exit();
       }
       //echo "Connexion BDD réussie.";

       if (!$mysqli->set_charset("utf8")) {
        printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
        exit();
       }

       if ( $_POST['pseudo'] && $_POST['nom'] && $_POST['prenom'] && $_POST['mdp'] && $_POST['c_mdp'] && $_POST['email']) {
        $id=htmlspecialchars(addslashes($_POST['pseudo']));
        $nom=htmlspecialchars(addslashes($_POST['nom']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom']));
        $mdp=htmlspecialchars(addslashes($_POST['mdp']));
        $c_mdp=htmlspecialchars(addslashes($_POST['c_mdp']));
        $email=htmlspecialchars(addslashes($_POST['email']));

        if ( strcmp( $mdp, $c_mdp) == 0 ){
         echo "Bonjour," . $id . ".";
         echo "</br >";
         echo "Nom et prénom indiqués : " . $nom . " " . $prenom. ".";
         echo "</br >";
         echo "Email indiqué : " . $email . ".";
         echo "</br >";
         echo "Mot de passe choisi : " . $mdp . ".";
         echo "</br >";

         $requete1 = "insert into t_compte_cpt values (md5('" .$mdp. "'),'" .$id. "');";
         //echo($requete1);
         $result1 = $mysqli->query($requete1);

         if ($result1 == false) //Erreur lors de l’exécution de la requête
         {
          // La requête a echoué
          echo "Error: La requête a échoué \n";
          echo "Query: " . $requete1 . "\n";
          echo "Errno: " . $mysqli->errno . "\n";
          echo "Error: " . $mysqli->error . "\n";
          exit();
         }
          else //Requête réussie
         {
          echo "<br />";
          echo "Création du compte réussie !" . "\n";

          $requete2 = "insert into t_profil_pro values ('" .$prenom. "', '" .$nom. "', '" .$email. "', 'D', 'O', CURDATE(), '" .$id. "');";
          //echo($requete2);
          $result2 = $mysqli->query($requete2);

          if ($result2 == false) //Erreur lors de l’exécution de la requête
          {
           // La requête a echoué
           $requete3 = "delete from t_profil_pro where cpt_pseudo = " .$id. "";
           //echo($requete3);
           $result3 = $mysqli->query($requete3);
           echo "Error: La requête a échoué \n";
           echo "Query: " . $requete1 . "\n";
           echo "Errno: " . $mysqli->errno . "\n";
           echo "Error: " . $mysqli->error . "\n";
           exit();
          }
           else //Requête réussie
          {
           echo "<br />";
           echo "Inscription réussie !" . "\n";
          }
         }

        } else {
         echo "<p style=text-align:center;>";
         echo "Les mots de passe ne concordent pas.";
         echo "</br >";
         echo "<a href=inscription.php>";
         echo "Retour au formulaire d'inscription.";
         echo "</a>";
         echo "</p>";
        }

       } else {
        echo "<p style=text-align:center;>";
        echo "Veuillez remplir tout les champs.";
        echo "</br >";
        echo "<a href=inscription.php>";
        echo "Retour au formulaire d'inscription.";
        echo "</a>";
        echo "</p>";
       }

       $mysqli->close();
      ?>
    </div>
    <div class="menu_navigation">
      <div id="left">
        <div class="left"><img src="images/more_l.jpg" width="20" height="20" alt="" border="0" class="more" /></div>
        <div class="right"><a href="gallery.html">Page précédente</a></div>
      </div>
      <div id="right">
        <div class="right"><a href="gallery.html">Page suivante</a></div>
        <div class="left"><img src="images/more.jpg" width="20" height="20" alt="" border="0" class="more" /></div>
      </div>
    </div>
    <div class="title"> Inspiration Site </div>
    <div class="content_text"> <a href="#"><img src="images/s5.jpg" width="125" height="40" alt="" class="inspiration" /></a> <a href="#"><img src="images/s2.jpg" width="125" height="40" alt="" class="inspiration" /></a> <a href="#"><img src="images/s3.jpg" width="125" height="40" alt="" class="inspiration" /></a> <a href="#"><img src="images/s4.jpg" width="125" height="40" alt="" class="inspiration" /></a> <a href="#"><img src="images/s1.jpg" width="125" height="40" alt="" class="inspiration" /></a> </div>
  </div>
</div>
<div id="footer">
  <div id="footer_content">
    <div id="copyrights"> Quartz Solution.&copy; All Rights Reserved 2007 </div>
    <div id="madeby"> <a href="http://www.csscreme.com"><img src="images/csscreme_link.jpg" width="125" height="40" border="0" alt="" /></a><br />
      <a target="_blank" href="http://validator.w3.org/check?uri=referer">Xhtml</a> <a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer">css</a> </div>
  </div>
</div>
</body>
</html>
