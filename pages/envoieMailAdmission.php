<?php
require_once('identifier.php');
require_once('connexiondb.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

$idD=isset($_GET['idD'])?$_GET['idD']:"";

$requeteDemande="SELECT * FROM demandeAdmission where idDemande = $idD";
$resultatDemande=$pdo->query($requeteDemande);
$demande=$resultatDemande->fetch();

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

$mail->setFrom('admyncreamaroc@gmail.com' , 'Yncrea administration'); // Personnaliser l'envoyeur
$mail->addAddress($demande['mail'], $demande['fullName']); // Ajouter le destinataire

$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = 'Admission';
$mail->Body = "Bonjour,<br><br>
Nous faisons suite à votre demande d'admission à notre école YNCREA,
nous avons le plaisir de vous informer que votre demande à été acceptée.<br>
Pour plus d'informations contacter l'administration.<br>
Cordialement,<br>" ;
//$mail->Send();

if(!$mail->send()) {
    $msg='Erreur, message non envoyé.\n Mailer Error: ' . $mail->ErrorInfo;
    header("location:../pages/alert.php?msg=$msg");
 } else {
   $requete="update demandeAdmission
               set  etat='T'
               where idDemande=?";

   $params=array($idD);

   $resultatUpdate=$pdo->prepare($requete);
   $resultatUpdate->execute($params);

   header('location:demandeAdmissionAdmin.php');
 }


 ?>
