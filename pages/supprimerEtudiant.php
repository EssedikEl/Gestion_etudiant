<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $pdo->beginTransaction();

    $idEtudiant=isset($_GET['id'])?$_GET['id']:0;
    $date = getdate();
    $AnneeCourante = $date['year'];
    if($date['mon']==9 || $date['mon']==10 || $date['mon']==11 || $date['mon']==12){
        $anneeScolairePart1=$AnneeCourante;
        $anneeScolairePart2= $AnneeCourante+1;
    }
    else{
        $anneeScolairePart1=$AnneeCourante-1;
        $anneeScolairePart2= $AnneeCourante;
    }
    $anneeScolaire=$anneeScolairePart1.'/'.$anneeScolairePart2;

    $requeteReglement="select count(*) countReglement from reglementpartranche where idEtudiant = $idEtudiant";
    $resultatReglement=$pdo->query($requeteReglement);
    $ReglementListe=$resultatReglement->fetch();
    $countReglement=$ReglementListe['countReglement'];

    if($countReglement == 0){

      $requeteParent="select codeParent from Etudiant where idEtudiant = $idEtudiant";
      $resultatParent=$pdo->query($requeteParent);
      $codeParentListe=$resultatParent->fetch();
      $codeParent=$codeParentListe['codeParent'];

      try{
        echo $codeParent;

        $requete="delete from EtudiantAnneeScolaire where anneScolaire = '$anneeScolaire' and idEtudiant = $idEtudiant";
        $resultat=$pdo->query($requete);

        $requeteDelete="delete from Etudiant where idEtudiant = $idEtudiant";
        $resultatDelete=$pdo->query($requeteDelete);

        $requeteDeleteParent="delete from Parent where idParent = $codeParent";
        $resultatDeleteParent=$pdo->query($requeteDeleteParent);
        $pdo->commit();

      }catch(Exception $e){
        $pdo->rollBack();
        echo "Failed: " . $e->getMessage();
      }
      header('location:etudiants.php');
    }else{
      //Ajout alert
      $msg="Suppression Impossible : Cet étudiant a déjà fait des réglements";
      header("location:alert.php?message=$msg");
    }

    //header('location:etudiants.php');

?>
