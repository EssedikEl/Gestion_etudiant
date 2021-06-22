<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    require("../les_fonctions/fonctions.php");

    $nomEtudiant=isset($_GET['nomEtudiant'])?$_GET['nomEtudiant']:"";
    $prenomEtudiant=isset($_GET['prenomEtudiant'])?$_GET['prenomEtudiant']:"";
    $niveau=isset($_GET['niveau'])?$_GET['niveau']:"ALL";

    $size=isset($_GET['size'])?$_GET['size']:3;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

    $anneeScolaire = annee_scolaire_actuelle();

    if($niveau=="ALL"){
        $requete="select e.*,rpt.tranche1_O_N ,rpt.tranche2_O_N,
                  rpt.tranche3_O_N,rpt.tranche4_O_N
                from Etudiant e
                left join reglementParTranche rpt
                on e.idEtudiant = rpt.idEtudiant and rpt.anneeScolaire = '$anneeScolaire'
                where e.nomEtudiant like '%$nomEtudiant%'
                And   e.prenomEtudiant like '%$prenomEtudiant%'
                limit $size
                offset $offset"
                ;
        $requeteCount="select count(*) countE from Etudiant
                where nomEtudiant like '%$nomEtudiant%'
                And   prenomEtudiant like '%$prenomEtudiant%'"
                ;
    }else{
        $requete="select e.* ,rpt.tranche1_O_N ,rpt.tranche2_O_N,
                  rpt.tranche3_O_N,rpt.tranche4_O_N
                from Etudiant e,  EtudiantAnneeScolaire Eas
                left join reglementParTranche rpt
                on e.idEtudiant = rpt.idEtudiant and And rpt.anneeScolaire = '$anneeScolaire'
                where nomEtudiant like '%$nomEtudiant%'
                And   prenomEtudiant like '%$prenomEtudiant%'
                And   idniveau =  $niveau
                And   Eas.idEtudiant =  e.idEtudiant
                And   Eas.anneScolaire = '$anneeScolaire'
                limit $size
                offset $offset"
                ;
        $requeteCount="select count(*) countE from Etudiant e,  EtudiantAnneeScolaire Eas
        where nomEtudiant like '%$nomEtudiant%'
        And   prenomEtudiant like '%$prenomEtudiant%'
        And   idniveau =  $niveau
        And   Eas.idEtudiant =  e.idEtudiant
        And   Eas.anneScolaire = '$anneeScolaire'"
        ;
    }
    $resultatE=$pdo->query($requete);
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrEtudiant = $tabCount['countE'];
    $reste=$nbrEtudiant%$size;

    if($reste===0)
        $nbrPage=$nbrEtudiant/$size;
    else
        $nbrPage=floor($nbrEtudiant/$size)+1; //floor : la partie entière d'un nombre décimal
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des étudiants</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
        <div class="container">
            <div class="panel panel-success margetop">
                <div class="panel-heading">Rechercher des étudiants...</div>
                <div class="panel-body">
                   <form method="get" action="reglements.php" class="form-inline">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" name="nomEtudiant" placeholder="Taper le nom d'étudiant" class="form-control" value = "<?php echo $nomEtudiant ?>"/>
                        &nbsp
                        <label>Prénom :</label>
                        <input type="text" name="prenomEtudiant" placeholder="Taper le prénom d'étudiant" class="form-control" value ="<?php echo $prenomEtudiant ?>"/>
                    </div>
                        &nbsp
                        <label for="niveau">Niveau :</label>
                        <select name="niveau" class="form-control" id="niveau" onchange='this.form.submit()'>
                            <option value='ALL' <?php if($niveau == 'ALL') echo "selected"; ?>>Tous les niveaux</option>
                            <option value='1' <?php if($niveau == '1') echo "selected"; ?>>1ère année</option>
                            <option value='2' <?php if($niveau == '2') echo "selected"; ?>>2ème année</option>
                            <option value='3' <?php if($niveau == '3') echo "selected"; ?>>3ème année</option>
                        </select>
                        &nbsp
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Rechercher...
                        </button>
                        &nbsp &nbsp
                   </form>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des étudiants ( <?php echo $nbrEtudiant; if($nbrEtudiant==1) echo " étudiant"; else echo " étudiants";?> )</div>
                <div class="panel-body">
                   <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id étudiant</th>
                                <th>Nom étudiant</th>
                                <th>Prénom étudiant</th>
                                <th>Reglements</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($etudiant=$resultatE->fetch()){ ?>
                                <tr>
                                    <td><?php echo $etudiant['idEtudiant']; ?></td>
                                    <td><?php echo $etudiant['nomEtudiant']; ?></td>
                                    <td><?php echo $etudiant['prenomEtudiant']; ?></td>
                                    <td>
                                      <?php
                                          if($etudiant['tranche1_O_N']==1)
                                              echo '<span class="glyphicon glyphicon-ok text-success"></span>&nbsp';
                                          else{
                                              echo '<span class="glyphicon glyphicon-remove text-danger"></span>&nbsp';
                                          }
                                       ?>
                                       <?php
                                           if($etudiant['tranche2_O_N']==1)
                                              echo '<span class="glyphicon glyphicon-ok text-success"></span>&nbsp';
                                           else{
                                              echo '<span class="glyphicon glyphicon-remove text-danger"></span>&nbsp';
                                           }
                                        ?>
                                        <?php
                                            if($etudiant['tranche3_O_N']==1)
                                                echo '<span class="glyphicon glyphicon-ok text-success"></span>&nbsp';
                                            else{
                                              echo '<span class="glyphicon glyphicon-remove text-danger"></span>&nbsp';
                                            }
                                         ?>
                                         <?php
                                             if($etudiant['tranche4_O_N']==1)
                                                 echo '<span class="glyphicon glyphicon-ok text-success"></span>&nbsp';
                                             else{
                                               echo '<span class="glyphicon glyphicon-remove text-danger"></span>&nbsp';
                                             }
                                          ?>
                                    </td>
                                      <td>
                                      <?php if($etudiant['tranche1_O_N']==0 || $etudiant['tranche2_O_N']==0 || $etudiant['tranche3_O_N']==0 || $etudiant['tranche4_O_N']==0){ ?>

                                            <a href="nouveauReglement.php?id=<?php echo $etudiant['idEtudiant']; ?>">
                                              <span class="glyphicon glyphicon-plus"></span>
                                                Nouveau Règlement
                                            </a>

                                  <?php } ?>
                                  </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                   </table>
                   <div>
                        <ul class="pagination">
                            <?php for($i=1;$i<=$nbrPage;$i++) {?>
                                <li class="<?php if($i==$page) echo 'active'?>">
                                    <a href="reglements.php?page=<?php echo $i; ?>&nomEtudiant=<?php echo $nomEtudiant; ?>&prenomEtudiant=<?php echo $prenomEtudiant; ?>&niveau=<?php echo $niveau; ?>">
                                        page <?php echo $i ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                   </div>
                </div>
            </div>
        </div>
    </body>
</HTML>
