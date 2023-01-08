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
    <li><a href="galerie.php" class="nav">Galerie</a></li>
    <li><a href="livredor.php" class="nav">Livre d'or</a></li>
    <li><a href="inscription.php" class="nav">Inscription</a></li>
     <?php
     session_start();
      if( !isset($_SESSION['login']) || ($_SESSION['role'] == 'D') ){
        echo "<li><a href='session.php' class='nav'>Connexion</a></li>";
     } else {
     	echo "<li><a href='admin_accueil.php' class='nav'>Espace administration</a></li>";
     }
    ?>
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
      echo "<p style=text-align:center;>";
      echo ($conf['conf_TexteDeBienvenue']);
      echo "<br />";
      echo "</p>";
      echo "<p>";
      echo "L'exposition se tiendra du " . ($conf['conf_DateDeDebut']) . " au " . ($conf['conf_DateDeFin']) . " à l' " . ($conf['conf_lieu']) . " !";
      echo "<br />";
      echo "<br />";
      echo ($conf['conf_presentation']);
      echo "<br />";
      echo "<br />";
      echo "Le vernissage aura lieu le " . ($conf['conf_DateDeVernissage']) . ".";
      echo "</p>";
      echo "<h2 style=text-align:center;>";
      echo "Actualités";
      echo "<br />";
      echo "</h2>";
    }
    $requete2 = "select actu_titre, actu_texte, actu_DateDePublication, cpt_pseudo from t_actualite_actu order by actu_DateDePublication desc";
    $result2 = $mysqli->query($requete2);
    if ($result2 == false) //Erreur lors de l’exécution de la requête
    { // La requête a echoué
     echo "Error: La requête a echoué \n";
     echo "Errno: " . $mysqli->errno . "\n";
     echo "Error: " . $mysqli->error . "\n";
     exit();
    }
    else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
    {
     echo "<table>";
     while ($actu = $result2->fetch_assoc())
     {
      echo "<tr>";
      echo "<td>";
      echo ($actu['actu_titre']);
      echo "</td>";
      echo "<td>";
      echo ($actu['actu_texte']);
      echo "</td>";
      echo "<td>";
      echo ($actu['actu_DateDePublication']);
      echo "</td>";
      echo "<td>";
      echo ($actu['cpt_pseudo']);
      echo "</td>";
      echo "</tr>";
     }
     echo "</table>";
    }
    $mysqli->close();
    ?> 
    </div>
    <div>
      <a href="galerie.php">
      <h3 style="text-align:center;">Vers la galerie !</h3>
      </a>
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
