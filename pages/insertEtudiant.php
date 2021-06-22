<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $nomEtudiant=isset($_POST['nomEtudiant'])?$_POST['nomEtudiant']:"";
    $prenomEtudiant=isset($_POST['prenomEtudiant'])?$_POST['prenomEtudiant']:"";
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    $dateNaissance=isset($_POST['dateNaissance'])?$_POST['dateNaissance']:"";
    $civilite=isset($_POST['civiliteRadio'])?$_POST['civiliteRadio']:"";
    $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
    $anneeScolairePart1=isset($_POST['anneeScolairePart1'])?$_POST['anneeScolairePart1']:"";
    $anneeScolairePart2=isset($_POST['anneeScolairePart2'])?$_POST['anneeScolairePart2']:"";
    $anneeScolaire=$anneeScolairePart1 .'/'.$anneeScolairePart2;

    $requete="insert into etudiant (nomEtudiant,prenomEtudiant,dateNaissanceEtudiant,addresse,codeCivilite)
                            values (?,?,?,?,?)";
    $params=array($nomEtudiant,$prenomEtudiant,$dateNaissance,$adresse,$civilite);
    $resultatInsert=$pdo->prepare($requete);

    if ($resultatInsert->execute($params) === FALSE) {
        echo 'Unable to insert data';
    } else {
        $last_insert_id = $pdo->lastInsertId();
        $requeteNiveau="insert into EtudiantAnneeScolaire (idEtudiant, idNiveau, anneScolaire, doublons)
        values (?,?,?,?)";
        $paramsNiveau=array($last_insert_id,$niveau,$anneeScolaire,0);
        $resultatNiveauInsert=$pdo->prepare($requeteNiveau);
        $resultatNiveauInsert->execute($paramsNiveau);
    }

    header('location:etudiants.php');

?>
