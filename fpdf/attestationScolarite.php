<?php
require_once('../pages/identifier.php');
require_once('../pages/connexiondb.php');
require("../les_fonctions/fonctions.php");

//$pdo = new PDO("mysql:host=localhost;dbname=ecoledb", "root", "");


if (isset($_GET['ide']))
    $ide = $_GET['ide'];
else
    $ide = 0;

    $as = annee_scolaire_actuelle();

$identiteEtudiant = $pdo->query("SELECT * FROM etudiant WHERE idEtudiant=$ide");
$etudiant = $identiteEtudiant->fetch();

$nom_prenom = strtoupper($etudiant['nomEtudiant'] . "  " . $etudiant['prenomEtudiant']);

$date_naiss = dateEnToDateFr($etudiant['dateNaissanceEtudiant']);

$lieu_naiss = strtoupper($etudiant['lieuNaissanceEtudiant']);


$scolariteEtudiant = $pdo->query("SELECT idEtudiant,anneScolaire,nomNiveau
										FROM EtudiantAnneeScolaire eas, Niveau n
										WHERE idEtudiant = $ide
										AND eas.idNiveau= n.idNiveau
										AND anneScolaire='$as'");
$scolarite = $scolariteEtudiant->fetch();

$niveau = $scolarite['nomNiveau'];


require('fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A5');

//Ajouter une nouvelle page
$pdf->AddPage();

// entete
$pdf->Image('logo-yncrea-maroc.png', 9, 5, 50, 20);

// Saut de ligne
$pdf->Ln(18);


// Police Arial gras 16
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'CERTIFICAT DE SCOLARITE', 'TB', 1, 'C');

// Saut de ligne
$pdf->Ln(18);

// Début en police Arial normale taille 10

$pdf->SetFont('Arial', '', 10);
$h = 7;

$pdf->Write($h, "Le Directeur , certifie que ");

//Ecriture en Gras-Italique-Souligné(U)
$pdf->SetFont('', 'BI');
$pdf->Write($h, $nom_prenom . ",");

//Ecriture normal
$pdf->SetFont('', '');

$pdf->Write($h, " né (e) le " . $date_naiss." à " );

$pdf->SetFont('', 'BI');
$pdf->Write($h, $lieu_naiss . ", ");

//Ecriture normal
$pdf->SetFont('', '');

$pdf->Write($h, "est régulièrement inscrit");

$pdf->SetFont('', 'BI');
$pdf->Write($h, "en Yncrea Maroc " . $niveau);

//Ecriture normal
$pdf->SetFont('', '');
$pdf->Write($h, " pour l'année scolaire ". $as.".");

$pdf->Ln(20);

$pdf->Cell(50);
$pdf->Cell(0, 5, 'Fait à Rabat Le : ' . date('d/m/Y'), 0, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Cell(50);
$pdf->Cell(80, 8, "Le directeur des Etudes", 0, 1, 'C');

//Afficher le pdf
$pdf->Output('', '', true);
?>