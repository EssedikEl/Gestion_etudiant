<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $nomEtudiant=isset($_GET['nomEtudiant'])?$_GET['nomEtudiant']:"";
    $prenomEtudiant=isset($_GET['prenomEtudiant'])?$_GET['prenomEtudiant']:"";
    $niveau=isset($_GET['niveau'])?$_GET['niveau']:"ALL";


?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menuVisiteur.php");?>
                      <br><br><br>
        <div class="jumbotron jumbotron-fluid bg-info text-white text-center" style="background: #6495ED;">
            <div class="container">
              <h1 class="display-1">Bienvenue sur le portail d'amission <strong>Yncrea Maroc</strong></h1><br><br>
              <a href="pageAdmission.php ">
              <button type="button" class="btn btn-info btn-lg"><i class="glyphicon glyphicon-education"></i> &nbsp Déposer une candidature</button>
            </a>
            </div>
        </div>
    </body>
</HTML>
