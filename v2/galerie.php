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
  <div id="page_content">
    <div class="title" style="text-align:center;"> Les bateaux </div>
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
    
     $id = 1;
     for( $id = 1; $id <= 12; $id = $id + 1 ){
      $requete1 = "select * from t_oeuvre_oeu where oeu_code = ".$id." ;";
      $result1 = $mysqli->query($requete1);
      if ($result1 == false) //Erreur lors de l’exécution de la requête
      { // La requête a echoué
       echo "Error: La requête a echoué \n";
       echo "Errno: " . $mysqli->errno . "\n";
       echo "Error: " . $mysqli->error . "\n";
       exit();
      }
      else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
      {
        $requete1_2 = "select * from t_exposant_expo join t_presentation_pres using (expo_identifiant) where oeu_code = ".$id." ;";
        $result1_2 = $mysqli->query($requete1_2);
        if ($result1_2 == false) //Erreur lors de l’exécution de la requête
        { // La requête a echoué
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
        }
        else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
        {
         $expo = $result1_2->fetch_assoc();
         echo "<div class='content_text'>";
         while ($oeuvre = $result1->fetch_assoc())
         {
          echo "<a href='./oeuvre.php?id=".$id."'>";
          echo "<img src='images/pic/".$oeuvre['oeu_CheminPhoto'].".jpg' width='100' height='100' alt='".$oeuvre['oeu_intitule']."' class='gallery' />";
          echo "</a>";
         }
         echo "</div>";
        }
       }
     }

    $mysqli->close();
    ?>
  </br>
    <div class="content_text"> <a href="#"><img src="images/s5.jpg" width="300" height="100" alt="" class="inspiration" /></a> </div>
  </div>
</div>
</body>
</html>