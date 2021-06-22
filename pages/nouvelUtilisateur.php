<?php
require_once("connexiondb.php");
require_once("../les_fonctions/fonctions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$login=$_POST['login'];
$pwd1=$_POST['pwd1'];
$pwd2=$_POST['pwd2'];
$email=$_POST['email'];

    $validationErrors=array();
    if(isset($login)){
      if(empty($login)){
        $validationErrors[]="Erreur!!! Le login ne doit pas etre vide";
      }
    }
    if(isset($pwd1)&&isset($pwd2)){

      if(empty($pwd1)){
        $validationErrors[]="Erreur!!! Le mot de passe ne doit pas etre vide";
      }
      if(md5($pwd1)!=md5($pwd2)){
        $validationErrors[]="Erreur!!! Les deux mot de passe ne sont pas indentiques";
      }
    }
    if(isset($email)) {
      $filtredEmail = filter_var($login,FILTER_SANITIZE_EMAIL);

      if($filtredEmail != true){
        $validationErrors[]="Erreur!!! Email non valide";
      }
    }
    if(empty($validationErrors)){
      if(rechercher_par_login($login)==0 && rechercher_par_email($email) ==0){
        $requete=$pdo->prepare("INSERT INTO utilisateurs(login,email,pwd,role,etat)
                                    VALUES(:plogin,:pemail,:ppwd,:prole,:petat)");
        $requete->execute(array('plogin'    =>$login,
                                'pemail'    =>$email,
                                'ppwd'      => md5($pwd1),
                                'prole'     =>'VISITEUR',
                                'petat'     =>1));

        $success_msg="Félicitation, votre compte est crée";
      }else{
        if (rechercher_par_login($login)>0){
          $validationErrors[]='Désolé le login exsite deja';
        }
        if (rechercher_par_email($email)>0){
          $validationErrors[]='Désolé cet email exsite deja';
        }
      }

    }
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nouvel utilisateur</title>
    <style>
      input{
        height: 35px;
        width: 600px;
        font-size: 20px;
      }

    </style>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
  </head>
  <body>
      <div class="jumbotron jumbotron-fluid bg-info text-white text-center" style="background: #6495ED;">
          <div class="container">
            <h1 class="display-1">Création d'un nouveau compte</h1>
          </div>
      </div>
    <div class="container col-lg-6 col-lg-offset-3 text-center">
      <form class="form" method="post">
          <input type="text"
                 size="80"
                 required="required"
                 name="login"
                 placeholder="Taper votre nom d'utilisateur"
                 autocomplete="off"
                 class="from-control"><br><br>
          <input type="email"
                 size="80"
                 required="required"
                 name="email"
                 placeholder="Taper votre email"
                 autocomplete="off"
                 class="from-control"><br><br>
          <input type="password"
                 size="80"
                  required="required"
                  name="pwd1"
                  placeholder="Création mot de passe"
                  autocomplete="new-password"
                  class="from-control"><br><br>
          <input type="password"
                 size="80"
                  required="required"
                  name="pwd2"
                  placeholder="Confirmer mot de passe"
                  autocomplete="new-password"
                  class="from-control"><br><br>
          <input type="submit" class="btn btn-primary" value="Enregistrer...">

      </form>
      <br>
      <?php
      if(isset($validationErrors) && !empty($validationErrors)){
        foreach ($validationErrors as $value) {
          echo '<div class="alert alert-danger">' .$value. '</div>';
        }
      }
       ?>
    </div>
  </body>
</html>
