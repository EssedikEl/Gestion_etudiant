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
    $adresse=$etudiant['addresse'];
    $civilite=$etudiant['codeCivilite'];
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

      $requeteTarifAll="select SUM(prix) as total from Tarif where idNiveau = $niveau";
      $resultatTarifAll=$pdo->query($requeteTarifAll);
      $tarifAll=$resultatTarifAll->fetch();
      $montantApayerAll=$tarifAll['total']-$tarifAll['total']*5/100;

      $requeteTarif="select * from Tarif where idNiveau = $niveau";
      $resultatTarif=$pdo->query($requeteTarif);
      while($tarif=$resultatTarif->fetch()){
        if($tarif['codePeriode']==1){
          $prixTranche1= $tarif['prix'];
        }elseif ($tarif['codePeriode']==2) {
          $prixTranche2= $tarif['prix'];
        }elseif ($tarif['codePeriode']==3) {
          $prixTranche3= $tarif['prix'];
        }elseif ($tarif['codePeriode']==4) {
          $prixTranche4= $tarif['prix'];
        }
      }

      $requeteTranches= "select * from reglementParTranche where idEtudiant = $idEtudiant and anneeScolaire = '$anneeScolaire'";
      $resultatTranches=$pdo->query($requeteTranches);
      $Tranches=$resultatTranches->fetch();

      $requetePeriode="select * from periode where 1=1";
      if($Tranches == TRUE){
        if($Tranches['tranche1_O_N'] == 1){
          $nextPeriod = 2;
        }
        if($Tranches['tranche2_O_N'] == 1){
          $nextPeriod = 3;
        }
        if($Tranches['tranche3_O_N'] == 1){
          $nextPeriod = 4;
        }
      }else{
        $nextPeriod = 1;
      }
      $requetePeriode=$requetePeriode." and idPeriode = $nextPeriod ";
      $resultatPeriode=$pdo->query($requetePeriode);


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
                <form method="post" action="insertReglement.php" class="form">
                    <div class="form-group">
                        <label>Identifiant de l'étudiant : <?php echo $idEtudiant; ?></label>
                        <input type="hidden" name="idEtudiant"
                        class="form-control" value="<?php echo $idEtudiant; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Nom d'étudiant: <?php echo $nomEtudiant.' '.$prenomEtudiant; ?> </label>
                    </div>
                    <div class="form-group">
                        <label>Date de règlement :</label>
                        <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control" name="dateReglement" value="sysdate" required='required'/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tranche">Tranche :</label>
                        <select name="tranche" class="form-control" id="tranche" required='required'>
                            <option selected disabled>-- Choisis la période à régler --</option>
                            <?php if($Tranches == FALSE){ ?>
                            <option value="ALL">Toutes les tranches</option>
                            <?php } ?>
                            <?php while($period=$resultatPeriode->fetch()){ ?>
                              <option value="<?php echo $period['idPeriode'] ?>"><?php echo $period['nomPeriod'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <div class="input-group col-sm-4">
                        <div class="input-group-addon">
                          <span class="input-group-text">DH</span>
                        </div>
                        <input type="text" class="form-control" name="montant" id="montant" required='required' aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-addon">
                          <span class="input-group-text">.00</span>
                        </div>
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
                    format:'YYYY/MM/DD',
                    maxDate:new Date()
                });
            });

                $(function(){
                  $("#tranche").change(function(){
                    var displayPeriod=$("#tranche option:selected").text();
                    if(displayPeriod=="Pre inscription"){
                        $("#montant").val(<?php echo $prixTranche1 ?>);
                    }else if (displayPeriod=="Octobre") {
                        $("#montant").val(<?php echo $prixTranche2 ?>);
                    }else if (displayPeriod=="Janvier") {
                        $("#montant").val(<?php echo $prixTranche3 ?>);
                    }else if (displayPeriod=="Avril") {
                        $("#montant").val(<?php echo $prixTranche4 ?>);
                    }else if(displayPeriod=="Toutes les tranches"){
                      $("#montant").val(<?php echo $montantApayerAll ?>);
                    }

                  })
                })
        </script>
    </body>
</HTML>
