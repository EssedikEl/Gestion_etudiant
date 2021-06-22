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
    $emailEtudiant=isset($_POST['mail'])?$_POST['mail']:"";
    $phoneEtudiant=isset($_POST['phone'])?$_POST['phone']:"";
    $lieuNaissance=isset($_POST['lieuN'])?$_POST['lieuN']:"";

    $nomPere=isset($_POST['nomPere'])?$_POST['nomPere']:"";
    $prenomPere=isset($_POST['prenomPere'])?$_POST['prenomPere']:"";
    $emailPere=isset($_POST['emailPere'])?$_POST['emailPere']:"";
    $phonePere=isset($_POST['phonePere'])?$_POST['phonePere']:"";
    $nomMere=isset($_POST['nomMere'])?$_POST['nomMere']:"";
    $prenomMere=isset($_POST['prenomMere'])?$_POST['prenomMere']:"";
    $emailMere=isset($_POST['emailMere'])?$_POST['emailMere']:"";
    $phoneMere=isset($_POST['phoneMere'])?$_POST['phoneMere']:"";

    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTmp=isset($_FILES['photo']['tmp_name'])?$_FILES['photo']['tmp_name']:"";
    move_uploaded_file($imageTmp,"../images/".$nomPhoto);

    $requete="insert into etudiant (nomEtudiant,prenomEtudiant,dateNaissanceEtudiant,lieuNaissanceEtudiant,addresse,codeCivilite,photo,emailEtudiant,telEtudiant)
        values (?,?,?,?,?,?,?,?,?)";
    $params=array($nomEtudiant,$prenomEtudiant,$dateNaissance,$lieuNaissance,$adresse,$civilite,$nomPhoto,$emailEtudiant,$phoneEtudiant);


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

        $requeteParent="Insert into Parent (nomPere,prenomPere,telPere,emailPere,nomMere,prenomMere,telMere,emailMere)
                        values (?,?,?,?,?,?,?,?)";
        $paramsParent=array($nomPere,$prenomPere,$phonePere,$emailPere,$nomMere,$prenomMere,$phoneMere,$emailMere);
        $resultatParent=$pdo->prepare($requeteParent);
        if($resultatParent->execute($paramsParent) === FALSE){
            echo 'Unable to insert Parent data';
        }else{
            $last_insert_id_Parent = $pdo->lastInsertId();
            $updateEtudiant="update Etudiant set codeParent = $last_insert_id_Parent where idEtudiant = $last_insert_id";
            $resultatUpdateE=$pdo->query($updateEtudiant);
        }
    }

    header('location:etudiants.php');

?>
