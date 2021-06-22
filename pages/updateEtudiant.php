<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $idEtudiant=isset($_POST['idEtudiant'])?$_POST['idEtudiant']:0;
    $nomEtudiant=isset($_POST['nomEtudiant'])?$_POST['nomEtudiant']:"";
    $prenomEtudiant=isset($_POST['prenomEtudiant'])?$_POST['prenomEtudiant']:"";
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    $dateNaissance=isset($_POST['dateNaissance'])?$_POST['dateNaissance']:"";
    $civilite=isset($_POST['civiliteRadio'])?$_POST['civiliteRadio']:"";
    $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
    $anneeScolairePart1=isset($_POST['anneeScolairePart1'])?$_POST['anneeScolairePart1']:"";
    $anneeScolairePart2=isset($_POST['anneeScolairePart2'])?$_POST['anneeScolairePart2']:"";
    $anneeScolaire=$anneeScolairePart1 .'/'.$anneeScolairePart2;
    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTmp=isset($_FILES['photo']['tmp_name'])?$_FILES['photo']['tmp_name']:"";
    move_uploaded_file($imageTmp,"../images/".$nomPhoto);

    if(empty($nomPhoto)){
        $requete="update etudiant
                    set nomEtudiant=? ,
                        prenomEtudiant=? ,
                        dateNaissanceEtudiant=? ,
                        addresse=? ,
                        codeCivilite=?
                    where idEtudiant=?";
        $params=array($nomEtudiant,$prenomEtudiant,$dateNaissance,$adresse,$civilite,$idEtudiant);
    }else{
        $requete="update etudiant
                    set nomEtudiant=? ,
                        prenomEtudiant=? ,
                        dateNaissanceEtudiant=? ,
                        addresse=? ,
                        codeCivilite=?,
                        photo=?
                    where idEtudiant=?";
        $params=array($nomEtudiant,$prenomEtudiant,$dateNaissance,$adresse,$civilite,$nomPhoto,$idEtudiant);
    }
    $resultatUpdate=$pdo->prepare($requete);
    $resultatUpdate->execute($params);

    header('location:etudiants.php');

?>
