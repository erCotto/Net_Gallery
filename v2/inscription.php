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
  </ul>
</div>
<div id="main_content">
  <div id="top_banner"> <a href="#"><img src="images/logo.jpg" width="230" height="130" alt="" border="0" class="logo" /></a> </div>
  <div id="page_content">
    <div class="title">
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
    $requete1 = "select conf_intitule, conf_DateDeDebut, conf_DateDeFin, conf_presentation, conf_lieu, conf_DateDeVernissage, conf_TexteDeBienvenue from t_configuration_conf where conf_expo_id = 1;";
    $result1 = $mysqli->query($requete1);
    if ($result1 == false) //Erreur lors de l’exécution de la requête
    { // La requête a echoué
     echo "Error: La requête a echoué \n";
     echo "Errno: " . $mysqli->errno . "\n";
     echo "Error: " . $mysqli->error . "\n";
     exit();
    }
    else
    {
      $conf = $result1->fetch_assoc();
      echo "<h1 style=text-align:center;>";
      echo ($conf['conf_intitule']);
      echo "</h1>";
      echo "<h2 style=text-align:center;>";
      echo "Inscription";
      echo "<br />";
      echo "</h2>";
      echo "<br />";
    }
    $mysqli->close();
    ?> 
    </div>
    <div id="contenu">
     <form action="action.php" method="post">
      <p>Votre pseudo : <input type="text" name="pseudo" /></p>
      <p>Nom : <input type="text" name="nom" /></p>
      <p>Prenom : <input type="text" name="prenom" /></p>
      <p>Mot de passe : <input type="text" name="mdp" /></p>
      <p>Confirmation du mot de passe : <input type="text" name="c_mdp" /></p>
      <p>Email : <input type="text" name="email" /></p>
      <p><input type="submit" value="Valider"></p>
     </form>
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
