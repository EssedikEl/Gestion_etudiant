<?php
require_once('identifier.php');
require_once('connexiondb.php');
require("../les_fonctions/fonctions.php");

$idEtudiant=isset($_POST['idEtudiant'])?$_POST['idEtudiant']:0;
$dateReglement=isset($_POST['dateReglement'])?$_POST['dateReglement']:"";
$tranche=isset($_POST['tranche'])?$_POST['tranche']:"";
$montant=isset($_POST['montant'])?$_POST['montant']:"";

$as = annee_scolaire_actuelle();

$tranche1_O_N = 0;
$tranche2_O_N = 0;
$tranche3_O_N = 0;
$tranche4_O_N = 0;

if ($tranche=="1"){
  $tranche1_O_N = 1;
}elseif ($tranche=="2") {
  $tranche2_O_N = 1;
}elseif ($tranche=="3") {
  $tranche3_O_N = 1;
}elseif ($tranche=="4") {
  $tranche4_O_N = 1;
}elseif ($tranche=="ALL") {
  $tranche1_O_N = 1;
  $tranche2_O_N = 1;
  $tranche3_O_N = 1;
  $tranche4_O_N = 1;
  $tranche=0;
}

$requeteInsert="insert into reglement (dateReglement,montant,anneeScolaire,periodReglement,idEtudiant)
                values (?,?,?,?,?)";

$paramsInsert=array($dateReglement,$montant,$as,$tranche,$idEtudiant);
$resultatInsert=$pdo->prepare($requeteInsert);
$resultatInsert->execute($paramsInsert);

$requeteSelectTranches="select * from reglementParTranche where idEtudiant=$idEtudiant and anneeScolaire = '$as'";
$resultatSelectTranches=$pdo->query($requeteSelectTranches);
if($tranches=$resultatSelectTranches->fetch()){
  if ($tranche=="1"){
    $requete="update reglementParTranche
                set tranche1_O_N=1
                where idEtudiant=$idEtudiant
                and anneeScolaire ='$as'";
  }elseif ($tranche=="2") {
    $requete="update reglementParTranche
                set tranche2_O_N=1
                where idEtudiant=$idEtudiant
                and anneeScolaire ='$as'";
  }elseif ($tranche=="3") {
    $requete="update reglementParTranche
                set tranche3_O_N=1
                where idEtudiant=$idEtudiant
                and anneeScolaire ='$as'";
  }elseif ($tranche=="4") {
    $requete="update reglementParTranche
                set tranche4_O_N=1
                where idEtudiant=$idEtudiant
                and anneeScolaire ='$as'";
  }elseif ($tranche=="ALL") {
    $requete="update reglementParTranche
                set tranche1_O_N=1 ,
                    tranche2_O_N=1 ,
                    tranche3_O_N=1 ,
                    tranche4_O_N=1
                where idEtudiant=$idEtudiant
                and anneeScolaire ='$as'";
  }

  $resultatUpdate=$pdo->query($requete);
}else{
  $requeteInsertTranche="Insert into reglementParTranche(idEtudiant,tranche1_O_N,tranche2_O_N,tranche3_O_N,tranche4_O_N,anneeScolaire)
                        values ($idEtudiant,$tranche1_O_N,$tranche2_O_N,$tranche3_O_N,$tranche4_O_N,'$as')";
  $resultatInsertTranche=$pdo->query($requeteInsertTranche);
}
    //header('location:reglements.php');
    header("location:../fpdf/recu_reglement.php?ide=$idEtudiant&tranche=$tranche");
 ?>
