
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: black;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">
            <img src="../images/yncrea.png" width="70%" style="margin-top: -12px;">
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="etudiants.php">Gestion des étudiants</a></li>
            <li><a href="reglements.php">Gestion des réglements</a></li>
            <li><a href="utilisateurs.php">Gestion des utilisateurs</a></li>
            <li><a href="demandeAdmissionAdmin.php"><i class="glyphicon glyphicon-list"></i>&nbsp Gestion des demandes d'amission</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="glyphicon glyphicon-user"></i><?php echo ' '.$_SESSION['user']['login']  ?></a></li>
            <li><a href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp Se deconnecter</a></li>
        </ul>
    </div>
</nav>
