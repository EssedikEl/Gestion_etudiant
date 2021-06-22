<?php
require_once('../pages/identifier.php');
require_once('../pages/connexiondb.php');
require("../les_fonctions/fonctions.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

//$pdo = new PDO("mysql:host=localhost;dbname=ecoledb", "root", "");


if (isset($_GET['ide']))
    $ide = $_GET['ide'];
else
    $ide = 0;

$tranche=isset($_GET['tranche'])?$_GET['tranche']:'';

    $as = annee_scolaire_actuelle();

$identiteEtudiant = $pdo->query("SELECT * FROM etudiant WHERE idEtudiant=$ide");
$etudiant = $identiteEtudiant->fetch();
$codeParent=$etudiant['codeParent'];

$identiteParent = $pdo->query("SELECT * FROM Parent WHERE idParent=$codeParent");
$parent=$identiteParent->fetch();
$parentMail=$parent['emailPere'];
$pereName=$parent['nomPere'].' '.$parent['prenomPere'];

$nom_prenom = strtoupper($etudiant['nomEtudiant'] . "  " . $etudiant['prenomEtudiant']);


$reglementEtudiant = $pdo->query("SELECT *
										FROM reglement
										WHERE idEtudiant = $ide
										AND anneeScolaire='$as'
                                        AND periodReglement = $tranche");

$reglement = $reglementEtudiant->fetch();

$dateReglement = dateEnToDateFr($reglement['dateReglement']);
$montant = $reglement['montant'];
$tranche = $reglement['periodReglement'];

if($tranche == "1"){
    $period = "Frais de pre inscription";
}elseif($tranche == "2"){
    $period = "Frais de la 1ère tranche";
}elseif($tranche == "3"){
    $period = "Frais de la 2ème tranche";
}elseif($tranche == "4"){
    $period = "Frais de la 3ème tranche";
}elseif($tranche == "0"){
    $period = "Frais annuelle";
}



require('fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A6');

//Ajouter une nouvelle page
$pdf->AddPage();

// entete
$pdf->Image('logo-yncrea-maroc.png', 9, 5, 50, 20);

// Saut de ligne
$pdf->Ln(18);


// Police Arial gras 16
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'Reçu de paiement', 'TB', 1, 'C');

// Saut de ligne
$pdf->Ln(18);

// Début en police Arial normale taille 10

$pdf->SetFont('Arial', '', 10);
$h = 7;

$pdf->Write($h, "Pour Mr/Melle : ");

//Ecriture en Gras-Italique-Souligné(U)
$pdf->SetFont('', 'BI');
$pdf->Write($h, $nom_prenom . "\n");

//Ecriture normal
$pdf->SetFont('', '');

$pdf->Write($h, "Montant : ");

$pdf->SetFont('', 'BI');
$pdf->Write($h, $montant." DH \n");

$pdf->Write($h, $period." \n");

$pdf->SetFont('', 'BI');
$pdf->Write($h, "Rabat le : " . $dateReglement);

// Décalage de 20 mm à droite
$pdf->Cell(50);
$pdf->Cell(80, 8, "Le directeur des Etudes", 0, 1, 'C');

//Afficher le pdf
$pdf->Output('../documents/recu_paiement_'.$ide.$tranche.'.pdf',"F");

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

$mail->setFrom('admyncreamaroc@gmail.com', 'Yncrea administration'); // Personnaliser l'envoyeur
$mail->addAddress($parentMail, $pereName); // Ajouter le destinataire

$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = 'Recu de paiement';
$mail->Body = '<html><body><center><font size=6>Le fichier est attaché ci-dessus</font><br></body></html>';
$mail->addAttachment('../documents/recu_paiement_'.$ide.$tranche.'.pdf');
//$mail->Send();

if(!$mail->send()) {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
 } else {
    header("location:../pages/reglements.php");
 }
?>
