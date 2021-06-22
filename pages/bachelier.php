<?php
    require_once('identifier.php');
    require_once('connexiondb.php');


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
                        <label>Comment vous appelez vous (Prénom & NOM) ?</label>
                        <input type="text" name="nomPrenom" placeholder="Répondez ici ..." class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label>Vous êtes joignable sur quel numéro de téléphone ?</label>
                        <input type="text" name="telephone" placeholder="+212672936218" class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label>Vous habitez quelle ville ?</label>
                        <input type="text" name="ville" placeholder="Répondez ici ..." class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label>Vous êtes en quel lycée ?</label>
                        <input type="text" name="lycee" placeholder="Répondez ici ..." class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label>Quelle est la filière de votre baccalauréat ?</label>
                        <select name="filiere" class="form-control" required='required'>
                            <option value='1'>Arts Appliqués</option>
                            <option value='2'>Langue Arabe</option>
                            <option value='3'>Lettres</option>
                            <option value='4'>Sc. & Technologies Electriques</option>
                            <option value='5'>Sc. & Technologies Mécaniques</option>
                            <option value='6'>Sc. Agronomiques</option>
                            <option value='7'>Sc. de la Chariaa</option>
                            <option value='8'>Sc. Economiques</option>
                            <option value='9'>Sc. Humaines</option>
                            <option value='10'>Sc. Mathématiques A</option>
                            <option value='11'>Sc. Mathématiques B</option>
                            <option value='12'>Sc. Physiques</option>
                            <option value='13'>SVT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pour le financement des études, vous comptez faire appel :</label>
                        <select name="financement" class="form-control" required='required'>
                            <option value='1'>Fonds propres (ex: parents)</option>
                            <option value='2'>Crédit Bancaire (prêt étudiant)</option>
                            <option value='3'>Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sur quelle adresse email vous souhaiteriez recevoir l'email de confirmation ?</label>
                        <input type="email" name="email" placeholder="nom@exemple.com" class="form-control" required='required'/>
                    </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-send"></span>
                            Envoyer
                        </button>
                   </form>
                </div>
            </div>
          </div>


    </div>


  </body>
</html>
