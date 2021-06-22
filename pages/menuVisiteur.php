
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: black;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">
            <img src="../images/yncrea.png" width="70%" style="margin-top: -12px;">
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="pageVisiteur.php"><i class="glyphicon glyphicon-home"></i>&nbsp Accueil</a></li>
            <li><a href="demandeAdmission.php"><i class="glyphicon glyphicon-list"></i>&nbsp Mes demandes d'amission</a></li>
            <li><a href="equipeAdmission.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp Contacter l'equipe admission</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="glyphicon glyphicon-user"></i><?php echo ' '.$_SESSION['user']['login']  ?></a></li>
            <li><a href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp Se deconnecter</a></li>
        </ul>
    </div>
</nav>
