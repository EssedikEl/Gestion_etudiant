<?php
require_once('identifier.php');
require_once('connexiondb.php');

$nomPrenom=isset($_POST['nomPrenom'])?$_POST['nomPrenom']:"";
$telephone=isset($_POST['telephone'])?$_POST['telephone']:"";
$ville=isset($_POST['ville'])?$_POST['ville']:"";
$ecole=isset($_POST['lycee'])?$_POST['lycee']:"";
$filiere=isset($_POST['filiere'])?$_POST['filiere']:"";
$financement=isset($_POST['financement'])?$_POST['financement']:"";
$email=isset($_POST['email'])?$_POST['email']:"";

$requeteInsert = "Insert into demandeAdmission
          (idUser,typeDemandeur,fullName,phone,ville,ecole,filiere,typefinancement,mail,etat)
          values (?,?,?,?,?,?,?,?,?,?)";
$paramsEtudiantB=array($_SESSION['user']['idUser'],'B',$nomPrenom,$telephone,$ville,$ecole,$filiere,$financement,$email,'S');
$resultatInsert=$pdo->prepare($requeteInsert);
$resultatInsert->execute($paramsEtudiantB);

header("location:demandeAdmission.php");
 ?>
