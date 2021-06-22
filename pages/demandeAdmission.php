<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    $size=isset($_GET['size'])?$_GET['size']:3;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    $idUser=$_SESSION['user']['idUser'];

    $requeteSelect="SELECT * FROM demandeAdmission where idUser= $idUser
                    limit $size
                    offset $offset";
    $resultatDemande=$pdo->query($requeteSelect);

    $requeteCount="SELECT count(*) countD FROM demandeAdmission where idUser=$idUser";
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrDemande = $tabCount['countD'];
    $reste=$nbrDemande%$size;

    if($reste===0)
        $nbrPage=$nbrDemande/$size;
    else
        $nbrPage=floor($nbrDemande/$size)+1;



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
        <?php include("menuVisiteur.php");?>
        <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Liste des demandes ( <?php echo $nbrDemande." demandes";?> )</div>
                <div class="panel-body">
                   <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id demande</th>
                                <th>Nom & prénom </th>
                                <th>Type de demandeur</th>
                                <th>Etat de la demande</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($demande=$resultatDemande->fetch()){ ?>
                                <tr>
                                    <td><?php echo $demande['idDemande']; ?></td>
                                    <td><?php echo $demande['fullName']; ?></td>
                                    <?php if($demande['etat']=='S') { ?>
                                      <td><?php echo "Saisie" ?></td>
                                    <?php }elseif($demande['etat']=='E'){ ?>
                                      <td><?php echo "En cours de traitement" ?></td>
                                    <?php }elseif($demande['etat']=='T'){ ?>
                                      <td><?php echo "Traitée" ?></td>
                                    <?php } ?>
                                    <?php if($demande['typeDemandeur']=='E') { ?>
                                    <td><?php echo "Etudiant" ?></td>
                                    <td>
                                        <a href="consulterDemandeS.php?id=<?php echo $demande['idDemande']; ?>" data-toggle="tooltip" title="Consulter demande">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    </td>
                                  <?php }else{ ?>
                                    <td><?php echo "Bachelier" ?></td>
                                    <td>
                                        <a href="consulterDemandeB.php?id=<?php echo $demande['idDemande']; ?>" data-toggle="tooltip" title="Consulter demande">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    </td>
                                  <?php }?>
                                </tr>
                            <?php } ?>
                        </tbody>
                   </table>
                   <div>
                        <ul class="pagination">
                            <?php for($i=1;$i<=$nbrPage;$i++) {?>
                                <li class="<?php if($i==$page) echo 'active'?>">
                                    <a href="demandeAdmission.php?page=<?php echo $i; ?>">
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
