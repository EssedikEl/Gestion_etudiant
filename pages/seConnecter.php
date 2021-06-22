<?php
    session_start();
    require_once('connexiondb.php');
    $login=isset($_POST['login'])?$_POST['login']:"";
    $pwd=isset($_POST['pwd'])?$_POST['pwd']:0;

    $requete="select * from utilisateurs where login = '$login' and pwd=md5('$pwd')";
    $resultat=$pdo->query($requete);

    if($user=$resultat->fetch()){
        if($user['etat']==1){
          $_SESSION['user']=$user;
          if($user['role']=="ADMIN"){
            header('location:../index.php');
          }else{
              header('location:pageVisiteur.php');
          }

        }else{
          $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Votre compte est désactivé.<br>Veuillez contacter l'administrateur";
          header('location:login.php');
        }
    }else{
        $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Login ou le mote de passe incorrecte!!!";
        header('location:login.php');
    }

?>
