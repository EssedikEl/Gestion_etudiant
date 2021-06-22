<?php
    require_once('identifier.php');
    session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;

        $requete="delete from utilisateurs where idUser = ?";
        $params=array($idUser);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        /*$resultat=$pdo->query($requete);


        $requeteDelete="delete from Etudiant where idEtudiant = $idEtudiant";
        $resultatDelete=$pdo->query($requeteDelete);*/

        header('location:utilisateurs.php');
    }else{

        header('location:login.php');
  }
?>
