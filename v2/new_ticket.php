<?php
 session_start();
 if( !isset($_SESSION['login']) || ($_SESSION['role'] == 'D') ){
  header("Location:session.php");
 }

?>
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
    <li><a href="index.php" class="nav">Accueil du site</a></li>
    <li><a href="admin_accueil.php" class="nav">Accueil et profil(s)</a></li>
    <li><a href="admin_accueil.php" class="nav">Gestion des actualités</a></li>
    <li><a href="admin_accueil.php" class="nav">Gestion des exposants</a></li>
    <li><a href="admin_accueil.php" class="nav">Gestion des oeuvres</a></li>
    <li><a href="admin_tickets.php" class="nav">Gestion des tickets visiteurs</a></li>
    <li><a href="admin_accueil.php" class="nav">Gestion de la configuration</a></li>
    <li><a href="deconnexion.php" class="nav">Déconnexion</a></li>
  </ul>
</div>
<br>
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
    
    $mdp = $_POST['mdp_vis'];
    $r_n_ticket = "insert into t_visiteurs_vis values (null, '" .$mdp. "', NOW(), null, null, null, '" .$_SESSION['login']. "');";
    $n_ticket = $mysqli->query($r_n_ticket);
    if( $n_ticket == false ){
        echo "Error: La requête m_ticket a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit();
    }

    header("Location:admin_tickets.php");

    $mysqli->close();
    ?> 
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
