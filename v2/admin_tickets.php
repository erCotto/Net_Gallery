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

     echo "<div id='contenu'>";
     echo "<form action='new_ticket.php' method = 'post'>
            <legend>Nouveau visiteur</legend>
            <fieldset>
            <p>Mot de passe : <input type='text' name='mdp_vis' length ='15' required='required'/></p>
            <p><input type='submit' value='Nouveau ticket'></p>
            </fieldset>
           </form>";
     echo "</div>";

    $tickets = "select t_visiteurs_vis.vis_id, vis_nom, vis_prenom, vis_email, com_text, vis_DateHeure, cpt_pseudo, com_etat from t_visiteurs_vis left outer join t_commentaire_com on t_visiteurs_vis.vis_id = t_commentaire_com.vis_id";

    $r_tickets = $mysqli->query($tickets);

    if( $r_tickets == false ){

      echo "Error: La requête tickets a echoué \n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit();

    } else {

      echo "<table>
             <tr>
              <td>Numéro</td>
              <td>Émetteur</td>
              <td>Entrée</td>
              <td>Nom</td>
              <td>Prenom</td>
              <td>Email</td>
              <td>Commentaire</td>
              <td>Visibilité</td>
             </tr>";

      while( $ticket = $r_tickets->fetch_assoc()){

        echo "<tr>";
        echo "<td>". $ticket['vis_id'] ."</td>";
        echo "<td>". $ticket['cpt_pseudo'] ."</td>";
        echo "<td>". $ticket['vis_DateHeure'] ."</td>";
        echo "<td>". $ticket['vis_nom'] ."</td>";
        echo "<td>". $ticket['vis_prenom'] ."</td>";
        echo "<td>". $ticket['vis_email'] ."</td>";
        echo "<td>". $ticket['com_text'] ."</td>";
        echo "<td>". $ticket['com_etat'] ."</td>";
        echo "</tr>";
      }

       echo "<table>";

       echo "<br>";

       echo "<form action='tickets_action.php' method='post'>
                <legend>Supprimer un visiteur :</legend>
                  <select name = 'vis_id'>
                   <p>Pseudo :";
                   $liste_visiteurs = "select vis_id from t_visiteurs_vis";
                   $r_liste_visiteurs = $mysqli->query($liste_visiteurs);
                   if( $r_liste_visiteurs == false ){

                     echo "Error: La requête liste_visiteur a echoué \n";
                     echo "Errno: " . $mysqli->errno . "\n";
                     echo "Error: " . $mysqli->error . "\n";
                     exit();

                   } else {
                     while( $visiteur = $r_liste_visiteurs->fetch_assoc()){

                      echo "<option value='". $visiteur['vis_id'] ."'>". $visiteur['vis_id'] ."</option>";

                     }

                     echo "<p><input type='submit' value='Valider'></p>";
                     echo "</form>";

                   }

    }

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
