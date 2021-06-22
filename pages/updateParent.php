<?php
        require_once('identifier.php');
        require_once('connexiondb.php');

        $codeParent=isset($_POST['codeParent'])?$_POST['codeParent']:"";
        $nomPere=isset($_POST['nomPere'])?$_POST['nomPere']:"";
        $prenomPere=isset($_POST['prenomPere'])?$_POST['prenomPere']:"";
        $emailPere=isset($_POST['mailPere'])?$_POST['mailPere']:"";
        $phonePere=isset($_POST['phonePere'])?$_POST['phonePere']:"";
        $nomMere=isset($_POST['nomMere'])?$_POST['nomMere']:"";
        $prenomMere=isset($_POST['prenomMere'])?$_POST['prenomMere']:"";
        $emailMere=isset($_POST['mailMere'])?$_POST['mailMere']:"";
        $phoneMere=isset($_POST['phoneMere'])?$_POST['phoneMere']:"";

        $requeteUpdate="update Parent set
                        nomPere=?,
                        prenomPere=?,
                        telPere=?,
                        emailPere=?,
                        nomMere=?,
                        prenomMere=?,
                        telMere=?,
                        emailMere=?
                        where idParent=?";
        $paramsParent=array($nomPere,$prenomPere,$phonePere,$emailPere,$nomMere,$prenomMere,$phoneMere,$emailMere,$codeParent);
        $resultatParent=$pdo->prepare($requeteUpdate);
        $resultatParent->execute($paramsParent);

        header('location:etudiants.php');
?>
