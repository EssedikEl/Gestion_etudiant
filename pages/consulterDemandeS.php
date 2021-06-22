<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $idDemande=isset($_GET['id'])?$_GET['id']:0;

    $requeteDemande="SELECT * FROM demandeAdmission where idDemande = $idDemande";
    $resultatDemande=$pdo->query($requeteDemande);
    $Demande=$resultatDemande->fetch();


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!--<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />-->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/moment.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php include("menuVisiteur.php");?>
                  <br><br><br>
    <div class="container margetop">
      <div class="row">
          <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Nous Contacter :</b></div>
                <div class="panel-body">
                <form method="" action="" class="form">
                    <div class="form-group">
                        <label>Identifiant de la demande : <?php echo $Demande['idDemande'] ?></label>
                    </div>
                    <div class="form-group">
                        <label>Prénom & NOM :</label>
                        <input type="text" name="nomPrenom" class="form-control" value="<?php echo $Demande['fullName'] ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Téléphone : </label>
                        <input type="text" name="telephone" class="form-control" value="<?php echo $Demande['phone'] ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Ville : </label>
                        <input type="text" name="ville" class="form-control" value="<?php echo $Demande['ville'] ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Ecole : </label>
                        <input type="text" name="ecole" class="form-control" value="<?php echo $Demande['ecole'] ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Niveau : </label>
                        <select name="niveau" class="form-control" readonly>
                            <option value='1' <?php if($Demande['niveau']==1) echo "selected" ?>>1ère année</option>
                            <option value='2' <?php if($Demande['niveau']==2) echo "selected" ?>>2ère année<</option>
                            <option value='3' <?php if($Demande['niveau']==3) echo "selected" ?>>3ère année<</option>
                            <option value='4' <?php if($Demande['niveau']==4) echo "selected" ?>>4ère année<</option>
                            <option value='5' <?php if($Demande['niveau']==5) echo "selected" ?>>5ère année<</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type de financemant : </label>
                        <select name="financement" class="form-control" readonly>
                            <option value='1' <?php if($Demande['typefinancement']==1) echo "selected" ?>>Fonds propres (ex: parents)</option>
                            <option value='2' <?php if($Demande['typefinancement']==2) echo "selected" ?>>Crédit Bancaire (prêt étudiant)</option>
                            <option value='3' <?php if($Demande['typefinancement']==3) echo "selected" ?>>Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email : </label>
                        <input type="email" name="email" value="<?php echo $Demande['mail'] ?>" class="form-control" readonly/>
                    </div>
                    <button type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-backward"></span>
                        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retour</a>
                    </button>
                   </form>
                </div>
            </div>
          </div>


    </div>


  </body>
</html>
