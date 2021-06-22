<?php
    require_once('identifier.php');
    require_once('identifier.php');
    $date = getdate();
    $AnneeCourante = $date['year'];
    if($date['mon']==9 || $date['mon']==10 || $date['mon']==11 || $date['mon']==12){
        $anneeScolairePart1=$AnneeCourante;
        $anneeScolairePart2= $AnneeCourante+1;
    }
    else{
        $anneeScolairePart1=$AnneeCourante-1;
        $anneeScolairePart2= $AnneeCourante;
    }
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouveau étudiant</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/moment.min.js"></script>
        <script src="../js/bootstrap-datetimepicker.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include("menu.php");?>
        <div class="container margetop">
            <div class="panel panel-primary">
                <div class="panel-heading">Veuillez Saisir les informations suivantes:</div>
                <div class="panel-body">
                <form method="post" action="insertEtudiant.php" class="form">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" name="nomEtudiant" placeholder="Taper votre nom" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Prénom :</label>
                        <input type="text" name="prenomEtudiant" placeholder="Taper votre prénom" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Date de naissance :</label>
                        <div class='input-group date' id='datetimepicker'>
                            <input type='text' class="form-control" name="dateNaissance"/>
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Adresse :</label>
                        <input type="text" name="adresse" placeholder="Taper votre adresse" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="radio-inline">
                            <label><input type="radio" name="civiliteRadio" value="M" checked>Masculin</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="civiliteRadio" value="F">Féminin</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="niveau">Niveau :</label>
                        <select name="niveau" class="form-control" id="niveau" >
                            <option value='1' selected>1ère année</option>
                            <option value='2'>2ème année</option>
                            <option value='3'>3ème année</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-sm-4">
                            <div class="input-group-addon">
                                <span class="input-group-text" id="">Année scolaire :</span>
                            </div>
                            <input type="text" name="anneeScolairePart1" class="form-control" value = "<?php echo $anneeScolairePart1 ?>"/>
                            <span class="input-group-btn" style="width:0px;"></span>
                            <input type="text" name="anneeScolairePart2" class="form-control" value = "<?php echo $anneeScolairePart2 ?>"/>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer...
                        </button>
                   </form>

                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                    format:'YYYY/MM/DD',
                    maxDate: new Date(new Date().getFullYear() - 17, 2,31)
                });
            });
        </script>
    </body>
</HTML>
