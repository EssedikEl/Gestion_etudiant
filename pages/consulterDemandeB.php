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
                <form method="post" action="insertDemandeBachelier.php" class="form">
                  <div class="form-group">
                      <label>Identifiant de la demande : <?php echo $Demande['idDemande'] ?></label>
                  </div>
                    <div class="form-group">
                        <label>Comment vous appelez vous (Prénom & NOM) ?</label>
                        <input type="text" name="nomPrenom" value="<?php echo $Demande['fullName'] ?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Vous êtes joignable sur quel numéro de téléphone ?</label>
                        <input type="text" name="telephone" value="<?php echo $Demande['phone'] ?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Vous habitez quelle ville ?</label>
                        <input type="text" name="ville" value="<?php echo $Demande['ville'] ?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Vous êtes en quel lycée ?</label>
                        <input type="text" name="lycee" value="<?php echo $Demande['ecole'] ?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Quelle est la filière de votre baccalauréat ?</label>
                        <select name="filiere" class="form-control" readonly>
                            <option value='1' <?php if($Demande['filiere']==1) echo "selected" ?>>Arts Appliqués</option>
                            <option value='2' <?php if($Demande['filiere']==2) echo "selected" ?>>Langue Arabe</option>
                            <option value='3' <?php if($Demande['filiere']==3) echo "selected" ?>>Lettres</option>
                            <option value='4' <?php if($Demande['filiere']==4) echo "selected" ?>>Sc. & Technologies Electriques</option>
                            <option value='5' <?php if($Demande['filiere']==5) echo "selected" ?>>Sc. & Technologies Mécaniques</option>
                            <option value='6' <?php if($Demande['filiere']==6) echo "selected" ?>>Sc. Agronomiques</option>
                            <option value='7' <?php if($Demande['filiere']==7) echo "selected" ?>>Sc. de la Chariaa</option>
                            <option value='8' <?php if($Demande['filiere']==8) echo "selected" ?>>Sc. Economiques</option>
                            <option value='9' <?php if($Demande['filiere']==9) echo "selected" ?>>Sc. Humaines</option>
                            <option value='10' <?php if($Demande['filiere']==10) echo "selected" ?>>Sc. Mathématiques A</option>
                            <option value='11' <?php if($Demande['filiere']==11) echo "selected" ?>>Sc. Mathématiques B</option>
                            <option value='12' <?php if($Demande['filiere']==12) echo "selected" ?>>Sc. Physiques</option>
                            <option value='13' <?php if($Demande['filiere']==13) echo "selected" ?>>SVT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pour le financement des études, vous comptez faire appel :</label>
                        <select name="financement" class="form-control" readonly>
                            <option value='1' <?php if($Demande['typefinancement']==1) echo "selected" ?>>Fonds propres (ex: parents)</option>
                            <option value='2' <?php if($Demande['typefinancement']==2) echo "selected" ?>>Crédit Bancaire (prêt étudiant)</option>
                            <option value='3' <?php if($Demande['typefinancement']==3) echo "selected" ?>>Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sur quelle adresse email vous souhaiteriez recevoir l'email de confirmation ?</label>
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
