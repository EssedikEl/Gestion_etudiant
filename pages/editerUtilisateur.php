
<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;

    $requeteUser="select * from utilisateurs where idUser = $idUser";
    $resultatUser=$pdo->query($requeteUser);
    $user=$resultatUser->fetch();

    $login=$user['login'];
    $email=$user['email'];
    $role=strtoupper($user['role']);

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un utilisateur</title>
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
                <div class="panel-heading">Edition de l'utilisateur: </div>
                <div class="panel-body">
                <form method="post" action="updateUtilisateur.php" class="form">
                    <div class="form-group">
                        <label>Identifiant de l'utilisateur : <?php echo $idUser; ?></label>
                        <input type="hidden" name="idUser"
                        class="form-control" value="<?php echo $idUser; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Login :</label>
                        <input type="text" name="login" placeholder="Taper votre login"
                        class="form-control" value="<?php echo $login; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="text" name="email" placeholder="Taper votre email"
                        class="form-control" value="<?php echo $email; ?>"/>
                    </div>
                    <div class="form-group">
                      <select name="role" class="from-control">
                        <option value="ADMIN" <?php if($role=="ADMIN") echo "selected" ?>>Administrateur</option>
                        <option value="VISITEUR" <?php if($role=="VISITEUR") echo "selected" ?>>Visiteur</option>

                      </select>
                    </div>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer...
                        </button>
                        &nbsp;&nbsp;

                        <a href="modifierPwd.php?idUser=<?php echo $idUser ?>">Changer le mot de passe </a>
                   </form>
                </div>
            </div>
        </div>
    </body>
</HTML>
