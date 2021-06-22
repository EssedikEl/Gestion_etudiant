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
    		<div class="container col-md-6 col-md-offset-3">
    			<h2>Vous êtes ?</h2>
    			<div class="panel panel-primary">
    				<div class="panel-body text-center">
    					<a href="bachelier.php"class="btn btn-warning" style="color: black;">
    						<b>Bachelier (ou futur bachelier)</b>
    					</a>&nbsp
              <a href="etudiantSup.php" class="btn btn-warning" style="color: black;">
    						<b>Etudiant (enseignement supérieur)</b>
    					</a>
    				</div>

    			</div>
    </body>
</HTML>
