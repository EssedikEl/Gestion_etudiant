<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idEtudiant=isset($_GET['id'])?$_GET['id']:0;

    $requete="select * from etudiant where idEtudiant = $idEtudiant";
    $resultat=$pdo->query($requete);
    $etudiant=$resultat->fetch();

    $nomEtudiant=$etudiant['nomEtudiant'];
    $prenomEtudiant=$etudiant['prenomEtudiant'];
    $dateNaissance=$etudiant['dateNaissanceEtudiant'];
    $lieuNaissance=$etudiant['lieuNaissanceEtudiant'];
    $adresse=$etudiant['addresse'];
    $civilite=$etudiant['codeCivilite'];
    $email=$etudiant['emailEtudiant'];
    $phone=$etudiant['telEtudiant'];
    $photo=$etudiant['photo'];
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
    $requeteniveau="select * from EtudiantAnneeScolaire where idEtudiant = $idEtudiant and anneScolaire = '$anneeScolaire'";
    $resultatniveau=$pdo->query($requeteniveau);
    $niveauEtudiant=$resultatniveau->fetch();
    $niveau= $niveauEtudiant['idNiveau'];
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un étudiant</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/moment.min.js"></script>
        <script src="../js/bootstrap-datetimepicker.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include("menu.php");?>
        <div class="container margetop">
            <div class="panel panel-primary">
                <div class="panel-heading">Edition de l'étudiant : </div>
                <div class="panel-body">
                <form method="post" action="updateEtudiant.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Identifiant de l'étudiant : <?php echo $idEtudiant; ?></label>
                        <input type="hidden" name="idEtudiant"
                        class="form-control" value="<?php echo $idEtudiant; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" name="nomEtudiant"
                        class="form-control" required='required' value="<?php echo $nomEtudiant; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Prénom :</label>
                        <input type="text" name="prenomEtudiant"
                        class="form-control" required='required' value="<?php echo $prenomEtudiant; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Date de naissance :</label>
                        <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control" name="dateNaissance" required='required' value="<?php echo date($dateNaissance); ?>"/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                            <label>Lieu de naissance:</label>
                            <input type="text" name="lieuN" required='required' value="<?php echo $lieuNaissance; ?>" class="form-control" />
                        </div>
                    <div class="form-group">
                        <label>Adresse :</label>
                        <input type="text" name="adresse"
                        class="form-control" required='required' value="<?php echo $adresse; ?>"/>
                    </div>
                    <div class="form-group">
                            <label>Email :</label>
                            <input type="text" name="mail" value="<?php echo $email; ?>" class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Tel :</label>
                            <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" required='required'/>
                        </div>
                    <div class="form-group">
                        <div class="radio-inline">
                            <label><input type="radio" name="civiliteRadio" value="M" <?php if($civilite=='M') echo "checked"; ?> >Masculin</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="civiliteRadio" value="F" <?php if($civilite=='F') echo "checked"; ?> >Féminin</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="niveau">Niveau :</label>
                        <select name="niveau" class="form-control" id="niveau" readonly>
                            <option value='1' <?php if($niveau==1) echo "selected"; else echo "disabled";?>>1ère année</option>
                            <option value='2' <?php if($niveau==2) echo "selected"; else echo "disabled";?>>2ème année</option>
                            <option value='3' <?php if($niveau==3) echo "selected"; else echo "disabled";?>>3ème année</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Photo :</label>
                        <div class='input-group'>
                            <input type="file" name="photo" id="photo" accept=".jpg, .png, .jpeg, .gif"
                            class="form-control"/>
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-picture"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-sm-4">
                            <div class="input-group-addon">
                                <span class="input-group-text" id="" required='required'>Année scolaire :</span>
                            </div>
                            <input type="text" name="anneeScolairePart1" class="form-control" value = "<?php echo $anneeScolairePart1; ?>" readonly/>
                            <span class="input-group-btn" style="width:0px;"></span>
                            <input type="text" name="anneeScolairePart2" class="form-control" value = "<?php echo $anneeScolairePart2; ?>" readonly/>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer...
                        </button>
                   </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                    format:'YYYY/MM/DD'
                });
            });

            document.getElementById("photo").addEventListener("change", validateFile);

            function validateFile(){
                const allowedExtensions =  ['jpg','png','gif','jpeg'],
                        sizeLimit = 1000000; // 1 megabyte

                // destructuring file name and size from file object
                const { name:fileName, size:fileSize } = this.files[0];

                /*
                * if filename is apple.png, we split the string to get ["apple","png"]
                * then apply the pop() method to return the file extension
                *
                */
                const fileExtension = fileName.split(".").pop();

                /*
                    check if the extension of the uploaded file is included
                    in our array of allowed file extensions
                */
                if(!allowedExtensions.includes(fileExtension)){
                    alert("file type not allowed");
                    this.value = null;
                }else if(fileSize > sizeLimit){
                    alert("file size too large");
                    this.value = null;
                }
            }
        </script>
    </body>
</HTML>
