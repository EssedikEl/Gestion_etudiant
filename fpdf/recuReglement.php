<?php
require_once('../pages/identifier.php');
require_once('../pages/connexiondb.php');
require("../les_fonctions/fonctions.php");

//$pdo = new PDO("mysql:host=localhost;dbname=ecoledb", "root", "");


if (isset($_GET['ide']))
    $ide = $_GET['ide'];
else
    $ide = 0;

$tranche=isset($_GET['tranche'])?$_GET['tranche']:'';

    $as = annee_scolaire_actuelle();

$identiteEtudiant = $pdo->query("SELECT * FROM etudiant WHERE idEtudiant=$ide");
$etudiant = $identiteEtudiant->fetch();

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
$pdf->Output('', '', true);
?>