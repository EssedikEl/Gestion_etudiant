<?php
require_once('identifier.php');
require_once('connexiondb.php');

$idD=isset($_GET['idD'])?$_GET['idD']:0;
$etat=isset($_GET['etat'])?$_GET['etat']:S;

if($etat=='S')
   $newEtat='E';


$requete="update demandeAdmission
            set  etat=?
            where idDemande=?";

$params=array($newEtat,$idD);

$resultatUpdate=$pdo->prepare($requete);
$resultatUpdate->execute($params);

header('location:demandeAdmissionAdmin.php');

 ?>
