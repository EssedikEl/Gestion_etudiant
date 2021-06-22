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
          <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Nous Contacter :</b></div>
                <div class="panel-body">
                <form method="post" action="envoyerMessage.php" class="form">
                    <div class="form-group">
                        <label>Votre Nom :</label>
                        <input type="text" name="nomContact" placeholder="Taper votre nom" class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label>Votre Prénom :</label>
                        <input type="text" name="prenomContact" placeholder="Taper votre prénom" class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label>Votre email :</label>
                        <input type="email" name="emailContact" placeholder="Taper votre email" required="required" autocomplete="off" class="form-control" required='required'/>
                    </div>
                    <div class="form-group">
                        <label for="montext" >Comment peut on vous aider ? </label><br>
                        <textarea id="montext" name="montext" rows="10" cols="40" required='required' /></textarea>
                    </div>


                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-send"></span>
                            Envoyer
                        </button>
                   </form>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Notre bureau :</b></div>
                <div class="panel-body">
                    <ul class="nav navbar-nav">
                      <li style="font-size: 20px; color: black;"><i class="glyphicon glyphicon-earphone" style="font-size: 2em; color: Green;"></i>&nbsp+212 (0) 537 63 67 97<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp+212 (0) 661 75 40 18</li><br>
                      <li style="font-size: 20px; color: black;"><a href="mailto:yousra.el-hassani@yncrea.fr" style="color: black;"><i class="glyphicon glyphicon-envelope" style="font-size: 2em; color: Green;"></i>&nbsp&nbsp yousra.el-hassani@yncrea.fr</a></li><br>
                      <li style="font-size: 20px; color: black;"><i class="glyphicon glyphicon-map-marker" style="font-size: 2em; color: Green;"></i>&nbsp17 avenue des Nations Unies 10000, RABAT</li>
                    </ul>
                </div>
          </div>
        </div>


    </div>


  </body>
</html>
