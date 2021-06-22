<?php
    session_start();
    if(isset($_SESSION['erreurLogin'])){
        $erreurLogin = $_SESSION['erreurLogin'];
    }
    else{
        $erreurLogin="";
    }
    session_destroy();
 ?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Se connecter</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/moment.min.js"></script>
        <script src="../js/bootstrap-datetimepicker.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container margetop col-lg-4 col-lg-offset-4 col-md-6 col-lg-offset-3 ">
            <div class="panel panel-primary">
                <div class="panel-heading">Se connecter</div>
                <div class="panel-body">
                <form method="post" action="seConnecter.php" class="form">
                  <?php if(!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin ?>
                    </div>
                  <?php } ?>
                    <div class="form-group">
                        <label>Login :</label>
                        <input type="text" name="login" placeholder="login" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Mot de passe :</label>
                        <input type="password" name="pwd" placeholder="Mot de passe" class="form-control"/>
                    </div>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-log-in"></span>
                            Se connecter
                        </button>
                        <a href="nouvelUtilisateur.php " class="pull-right">
                            <span class="glyphicon glyphicon-plus"></span>
                            Inscription
                        </a>
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
