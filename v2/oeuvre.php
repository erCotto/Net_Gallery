<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PhotoGallery - Details</title>
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
    <?php
     session_start();
      if( !isset($_SESSION['login']) || ($_SESSION['role'] == 'D') ){
        echo "<li><a href='session.php' class='nav'>Connexion</a></li>";
     }
    ?>
  </ul>
</div>
<div id="main_content">
  <div id="top_banner"> <a href="#"><img src="images/logo.jpg" width="230" height="130" alt="" border="0" class="logo" /></a> </div>
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
  echo "<div id='page_content_left'>";
    echo "<div class='title'>";
     
     if(isset($_GET['id'])){
      $oeu = $_GET['id'];
      if(( $oeu > 0 ) && ( $oeu < 13 )){
       $r_nom = "select oeu_intitule from t_oeuvre_oeu where oeu_code = ".$oeu." ;";
       $nom = $mysqli->query($r_nom);
       if ($nom == false) //Erreur lors de l’exécution de la requête
       { // La requête a echoué
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit();
       }
       else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
       {
        $oeu_info = $nom->fetch_assoc();
        echo ($oeu_info['oeu_intitule']);
       }
      } else {
        echo "Cette oeuvre n'existe pas.";
        exit();
      }
     } else {
      echo "Veuillez entrer l'identifiant de l'oeuvre souhaité dans l'URL.";
      exit();
     }

    echo "</div>";
      echo  "<div class='content_text'>";
     
      if(isset($_GET['id'])){
       $oeu = $_GET['id'];
       if(( $oeu > 0 ) && ( $oeu < 13 )){
        $r_photo = "select oeu_CheminPhoto from t_oeuvre_oeu where oeu_code = ".$oeu." ;";
        $photo = $mysqli->query($r_photo);
        if ($photo == false) //Erreur lors de l’exécution de la requête
        { // La requête a echoué
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
        }
        else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
        {
         $oeu_info = $photo->fetch_assoc();
         echo "<img src='./images/pic/".$oeu_info['oeu_CheminPhoto'].".jpg' width='365' height='190' alt='' class='pic' />";
        }
       } else {
        echo "Cette oeuvre n'existe pas.";
        exit();
       }
      } else {
       echo "Veuillez entrer l'identifiant de l'oeuvre souhaité dans l'URL.";
       exit();
      }

    echo "</div>";
    echo "<div class='title'> Le bateau </div>";

    if(isset($_GET['id'])){
       $oeu = $_GET['id'];
       if(( $oeu > 0 ) && ( $oeu < 13 )){
        $r_description = "select oeu_description from t_oeuvre_oeu where oeu_code = ".$oeu." ;";
        $description = $mysqli->query($r_description);
        if ($description == false) //Erreur lors de l’exécution de la requête
        { // La requête a echoué
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
        }
        else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
        {
         $oeu_info = $description->fetch_assoc();
         echo "<div class='content_text'>".$oeu_info['oeu_description']."</div>";
        }
       } else {
        echo "Cette oeuvre n'existe pas.";
        exit();
       }
      }
  echo "</div>";
  echo "<div id='page_content_right'>";
    $r_architectes = "select expo_identifiant from t_presentation_pres where oeu_code =".$oeu.";";
    $architectes = $mysqli->query($r_architectes);
    if ($architectes == false) //Erreur lors de l’exécution de la requête
        { // La requête a echoué
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
        }
        else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
        {
         while($exposants = $architectes->fetch_assoc()){
          $r_architecte = "select * from t_exposant_expo where expo_identifiant = ".$exposants['expo_identifiant'].";";
          $architecte = $mysqli->query($r_architecte);
          $exposant = $architecte->fetch_assoc();
          echo "<div class='title'>".$exposant['expo_nom']." ".$exposant['expo_prenom']."</div>";
          echo "<div class='content_text'> <img src='images/pic/big.jpg' width='365' height='190' alt='' class='pic' /> </div>";
          echo "<div class='title'> Biographie </div>";//images a telecharger et a gerer pour les afficher
          echo "<div class='content_text'> ".$exposant['expo_biographie']."</div>";
         }
        }
echo "</div>";

$mysqli->close();

    ?>
<div id="footer">
  <div id="footer_content">
    <div id="copyrights"> Quartz Solution.&copy; All Rights Reserved 2007 </div>
    <div>
      <ul class="footer_menu">
        <li><a href="#" class="nav2">home </a></li>
        <li><a href="#" class="nav2">services</a></li>
        <li><a href="#" class="nav2">gallery</a></li>
        <li><a href="#" class="nav2">contact</a></li>
      </ul>
    </div>
    <div id="madeby"> <a href="http://www.csscreme.com"><img src="images/csscreme_link.jpg" width="125" height="40" border="0" alt="" /></a><br />
      <a target="_blank" href="http://validator.w3.org/check?uri=referer">Xhtml</a> <a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer">css</a> </div>
  </div>
</div>
</body>
</html>
