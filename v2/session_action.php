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
    <li><a href="index.php" class="nav">Page d'accueil</a></li>
    <li><a href="galerie.php" class="nav">Galerie</a></li>
    <li><a href="livredor.php" class="nav">Livre d'or</a></li>
    <li><a href="inscription.php" class="nav">Inscription</a></li>
  </ul>
</div>
<div id="main_content">
  <div id="top_banner"> <a href="#"><img src="images/logo.jpg" width="230" height="130" alt="" border="0" class="logo" /></a> </div>
  <div id="page_content">
    <div class="title">
    <?php
     //Ouverture d'une session
     session_start();

     /*Affectation dans des variables du pseudo/mot de passe s'ils existent,
     affichage d'un message sinon*/
     if ($_POST["pseudo"] && $_POST["mdp"]){
      $id = $_POST["pseudo"];
      $motdepasse = $_POST["mdp"];

      // Connexion à la base MariaDB
      $mysqli = new mysqli('localhost','nom_utilisateur','mot_de_passe','nom_base');
      if ($mysqli->connect_errno) {
       // Affichage d'un message d'erreur
       echo "Error: Problème de connexion à la BDD \n";
       echo "Errno: " . $mysqli->connect_errno . "\n";
       echo "Error: " . $mysqli->connect_error . "\n";
       // Arrêt du chargement de la page
       exit();
      }

      $connexion = "select * from t_compte_cpt join t_profil_pro using(cpt_pseudo) where cpt_pseudo = '" . $id . "' and cpt_MotDePasse = md5('" . $motdepasse . "') and pro_validite = 'A';";
      $resultat = $mysqli->query($connexion);

      if ($resultat==false) {
       // La requête a echoué
       echo "Error: Problème d'accès à la base \n";
       exit();
      }
      else {
        if($resultat->num_rows == 1) {
          $ligne = $resultat->fetch_assoc();
          $_SESSION['login'] = htmlspecialchars(addslashes($id));
          $_SESSION['role'] = htmlspecialchars(addslashes($ligne['pro_validite']));
          header("Location:admin_accueil.php");
        } else{
         // aucune ligne retournée
         // => le compte n'existe pas ou n'est pas valide
         echo "<p style='text-align:center;'>Pseudo/mot de passe incorrect(s) ou profil inconnu !.";
         echo "<a href='session.php'>";
         echo "<br>Retour à l'écran de connexion.";
         echo "</a></p>";
        }
      }
     } else {
      echo "<p style='text-align:center;'>Veuillez remplir tout les champs.";
      echo "<a href='session.php'>";
      echo "<br>Retour à l'écran de connexion.";
      echo "</a></p>";
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
