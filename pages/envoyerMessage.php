<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

$nomContact=isset($_POST['nomContact'])?$_POST['nomContact']:"";
$prenomContact=isset($_POST['prenomContact'])?$_POST['prenomContact']:"";
$emailContact=isset($_POST['emailContact'])?$_POST['emailContact']:"";
$montext=isset($_POST['montext'])?$_POST['montext']:"";

//Créer une nouvelle instance de la classe
$mail = new PHPMailer(True);


$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
$mail->Host = 'ssl://smtp.gmail.com'; // Spécifier le serveur SMTP
$mail->SMTPAuth = true; // Activer authentication SMTP
$mail->Username = 'admyncreamaroc@gmail.com'; // Votre adresse email d'envoi
$mail->Password = '123sigma123'; // Le mot de passe de cette adresse email
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Accepter SSL
$mail->Port = 465;

$mail->setFrom($emailContact , $nomContact." ".$prenomContact); // Personnaliser l'envoyeur
$mail->addAddress('admyncreamaroc@gmail.com', 'Ycrea administration'); // Ajouter le destinataire

$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = 'Contacter pour information';
$mail->Body = "Contact full name : ".$nomContact." ".$prenomContact."<br>".
              "Contact email : ".$emailContact."<br>".
              "Contenu du message : ".$montext;
//$mail->Send();

if(!$mail->send()) {
    $msg='Erreur, message non envoyé.\n Mailer Error: ' . $mail->ErrorInfo;
    header("location:../pages/alert.php?msg=$msg");
 } else {
    header("location:../pages/pageVisiteur.php");
 }


 ?>
