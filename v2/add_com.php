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

    echo "<h1 style=text-align:center;>Page d'ajout d'un commentaire</h1>";

    $vis_id = htmlspecialchars(addslashes($_POST['vis_id']));
    $mdp = htmlspecialchars(addslashes($_POST['mdp']));
    $nom = htmlspecialchars(addslashes($_POST['nom']));
    $prenom = htmlspecialchars(addslashes($_POST['prenom']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $com = htmlspecialchars(addslashes($_POST['com']));

    echo "vis_id = ". $vis_id ."<br>";
    echo "mdp = ". $mdp ."<br>";
    echo "nom = ". $nom ."<br>";
    echo "prenom = ". $prenom ."<br>";
    echo "email = ". $email ."<br>";
    echo "commentaire = ". $com ."<br>";

    $r_vis = "set @id_3h_ok = (select vis_id from t_visiteurs_vis where vis_DateHeure <= NOW() and NOW() <= timestampadd(hour, 3, vis_DateHeure) and vis_id = " .$vis_id. " and vis_MotDePasse = '" .$mdp. "');";
    $r_vis2 = " select @id_3h_ok;";
    echo $r_vis;
    echo "<br>";
    echo $r_vis2;
    $vis = $mysqli->query($r_vis);
    $vis2 = $mysqli->query($r_vis2);

    if ($vis == false) //Erreur lors de l’exécution de la requête
    { // La requête a echoué
     echo "Error: La requête vis a echoué \n";
     echo "Errno: " . $mysqli->errno . "\n";
     echo "Error: " . $mysqli->error . "\n";
     header("Location:livredor.php");
     exit();
    }

    if ($vis2 == false) //Erreur lors de l’exécution de la requête
    { // La requête a echoué
     echo "Error: La requête verif visiteur a echoué \n";
     echo "Errno: " . $mysqli->errno . "\n";
     echo "Error: " . $mysqli->error . "\n";
     header("Location:livredor.php");
     exit();
    }
    else
    {
      echo "<br>";
      echo "la requête a réussi";
      $count = $vis2->num_rows;
      if( $count == 1 ){
        $vis3 = $vis2->fetch_assoc();
        echo "<br> vis = ";
        echo $vis3['@id_3h_ok'];

        $r_com = "insert into t_commentaire_com values(null, NOW(), '" .$com. "', 'V', " .$vis3['@id_3h_ok']. ");";
        echo "<br>" .$r_com;
        $com = $mysqli->query($r_com);

        if ($com == false) //Erreur lors de l’exécution de la requête
        { // La requête a echoué
          echo "Error: La requête com a echoué \n";
          echo "Errno: " . $mysqli->errno . "\n";
          echo "Error: " . $mysqli->error . "\n";
          header("Location:livredor.php");
          exit();
        } else {
          $r_maj_vis = "update t_visiteurs_vis set vis_nom = '" .$nom. "', vis_prenom = '" .$prenom. "', vis_email = '" .$email. "' where vis_id = " .$vis3['@id_3h_ok']. ";";
          echo "<br>" .$r_maj_vis;
          $maj_vis = $mysqli->query($r_maj_vis);
          if ($maj_vis == false) //Erreur lors de l’exécution de la requête
          { // La requête a echoué
            $r_delete = "delete from t_commentaire_com where vis_id = 10;";
            $delete = $mysqli->query($r_delete);
            echo "Error: La requête com a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            header("Location:livredor.php");
            exit();
          }
        }

      } else {
        echo "<br>";
        echo "temps expiré";
      }
    }

    header("Location:livredor.php");

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
