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

    $pseudo = $_SESSION['login'];
    $utilisateur = "select * from t_profil_pro where cpt_pseudo = '". $pseudo ."';";

    $infos_utilisateur = $mysqli->query($utilisateur);

    if ($infos_utilisateur == false) //Erreur lors de l’exécution de la requête
    { // La requête a echoué
     echo "Error: La requête a echoué \n";
     echo "Errno: " . $mysqli->errno . "\n";
     echo "Error: " . $mysqli->error . "\n";
     exit();
    }
    else
    {
      $infos = $infos_utilisateur->fetch_assoc();
      echo "<p>";
      echo "Pseudo : ". $infos['cpt_pseudo'] ."</br>";
      echo "Nom : ". $infos['pro_nom'] ."</br>";
      echo "Prenom : ". $infos['pro_prenom'] ."</br>";
      echo "Email : ". $infos['pro_email'] ."</br>";
      echo "Date de création : ". $infos['pro_DateDeCreation'] ."</br>";
      if( $infos['pro_role'] == 'A' ){
        echo "Rôle : administrateur</br>";

        $r_nbprofils = "select count(cpt_pseudo) as nb from t_profil_pro;";

        $nbprofils = $mysqli->query($r_nbprofils);
        if( $nbprofils == false ){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
        } else {
          $nb = $nbprofils->fetch_assoc();
          echo "Nombre de profils existant : ". $nb['nb'];

          $profils = "select * from t_profil_pro;";

          $liste_profils = $mysqli->query($profils);
          if ($liste_profils == false) //Erreur lors de l’exécution de la requête
          { // La requête a echoué
           echo "Error: La requête a echoué \n";
           echo "Errno: " . $mysqli->errno . "\n";
           echo "Error: " . $mysqli->error . "\n";
           exit();
          }
           else
          {
           echo "<table>";
           echo "<tr>";
           echo "<td>";
           echo "<h3>Pseudo</h3>";
           echo "</td>";
           echo "<td>";
           echo "<h3>Nom</h3>";
           echo "</td>";
           echo "<td>";
           echo "<h3>Prenom</h3>";
           echo "</td>";
           echo "<td>";
           echo "<h3>Email</h3>";
           echo "</td>";
           echo "<td>";
           echo "<h3>État</h3>";
           echo "</td>";
           echo "<td>";
           echo "<h3>Role</h3>";
           echo "</td>";
           echo "<td>";
           echo "<h3>Date de création</h3>";
           echo "</td>";
           echo "</tr>";
           while($profil = $liste_profils->fetch_assoc()){
            echo "<tr>";
            echo "<td>";
            echo $profil['cpt_pseudo'];
            echo "</td>";
            echo "<td>";
            echo $profil['pro_nom'];
            echo "</td>";
            echo "<td>";
            echo $profil['pro_prenom'];
            echo "</td>";
            echo "<td>";
            echo $profil['pro_email'];
            echo "</td>";
            echo "<td>";
            if( $profil['pro_validite'] == 'A' ){
              echo "activé";
            } else {
              echo "désactivé";
            }
            echo "</td>";
            echo "<td>";
            if( $profil['pro_role'] == 'A'){
              echo "administrateur";
            } else if ( $profil['pro_role'] == 'O'){
              echo "organisateur";
            } else {
              echo "aucun";
            }
            echo "</td>";
            echo "<td>";
            echo $profil['pro_DateDeCreation'];
            echo "</td>";
            echo "</tr>";
           }
           echo "</table>";

           echo "<br>";

           echo "<form action='comptes_action.php' method='post'>
                  <legend>Mise à jour d'un profil :</legend>
                  <select name = 'm_pseudo'>
                   <p>Pseudo :";
                   $liste_pseudo = "select cpt_pseudo from t_profil_pro";
                   $r_liste_pseudo = $mysqli->query($liste_pseudo);
                   if( $r_liste_pseudo == false ){
                     echo "Error: La requête liste_pseudo a echoué \n";
                     echo "Errno: " . $mysqli->errno . "\n";
                     echo "Error: " . $mysqli->error . "\n";
                     exit();
                   } else {
                   	 while( $pseudo = $r_liste_pseudo->fetch_assoc()){
                   	 	echo "<option value='". $pseudo['cpt_pseudo'] ."'>". $pseudo['cpt_pseudo'] ."</option>";
                   	 }
                   }
           echo   "</p>
                  </select>
                  <select name = 'm_etat'>
                   <p>État :
                    <option value='A'>Activer</option>
                    <option value='D'>Désactiver</option>
                   </p>
                  </select>
                   <p><input type='submit' value='Valider'></p>
                </form>";
          }
        }
      } else {
        echo "Rôle : organisateur</br>";
      }

      echo "<br>";

      echo "<form action = 'modif_admin.php' method = 'post'>
             <legend>Mise à jour de mes données :</legend>
              <fieldset>
               <p>Nom :
                <input type = 'text' name = 'n_nom' placeholder = 'nouveau nom' maxlength = '60'/>
               </p>
               <p>Prenom :
                <input type = 'text' name = 'n_prenom' placeholder = 'nouveau prenom' maxlength = '60'/>
               </p>
               <p>Email :
                <input type = 'email' name = 'n_email' placeholder = 'nouvel email' maxlength = '60'/>
               </p>
               <p>Mot de passe :
                <input type = 'password' name = 'n_mdp' placeholder = 'nouveau mot de passe'/>
               </p>
               <p>Confirmation du mot de passe :
                <input type = 'password' name = 'n_c_mdp' placeholder = 'confirmer le nouveau mot de passe'/>
               </p>
              </fieldset>
               <p><input type='submit' value='Valider'></p>
            </form>";
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
