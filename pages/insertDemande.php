<?php
require_once('identifier.php');
require_once('connexiondb.php');

$nomPrenom=isset($_POST['nomPrenom'])?$_POST['nomPrenom']:"";
$telephone=isset($_POST['telephone'])?$_POST['telephone']:"";
$ville=isset($_POST['ville'])?$_POST['ville']:"";
$ecole=isset($_POST['ecole'])?$_POST['ecole']:"";
$niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
$financement=isset($_POST['financement'])?$_POST['financement']:"";
$email=isset($_POST['email'])?$_POST['email']:"";

$requeteInsert = "Insert into demandeAdmission
          (idUser,typeDemandeur,fullName,phone,ville,ecole,typefinancement,mail,niveau,etat)
          values (?,?,?,?,?,?,?,?,?,?)";
$paramsEtudiantS=array($_SESSION['user']['idUser'],'E',$nomPrenom,$telephone,$ville,$ecole,$financement,$email,$niveau,'S');
$resultatInsert=$pdo->prepare($requeteInsert);
$resultatInsert->execute($paramsEtudiantS);

header("location:demandeAdmission.php");
 ?>
