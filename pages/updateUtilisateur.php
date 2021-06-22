<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $idUser=isset($_POST['idUser'])?$_POST['idUser']:0;
    $login=isset($_POST['login'])?$_POST['login']:"";
    $email=isset($_POST['email'])?$_POST['email']:"";
    $role=isset($_POST['role'])?$_POST['role']:"";

    $requete="update utilisateurs
                set login=? ,
                    email=? ,
                    role=?
                where idUser=?";

    $params=array($login,$email,$role,$idUser);

    $resultatUpdate=$pdo->prepare($requete);
    $resultatUpdate->execute($params);

    header('location:utilisateurs.php');

?>
