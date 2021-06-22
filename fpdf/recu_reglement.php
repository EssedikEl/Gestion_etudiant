<?php

	if(isset($_GET['ide']))
		$ide=$_GET['ide'];
	else
		$ide=0;

	$tranche=isset($_GET['tranche'])?$_GET['tranche']:-1;

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  Les Documents et les Attestations </title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	</head>
	<body>
		<br><br><br>
		<div class="container col-md-6 col-md-offset-3">
			<h2>Séléctionner le document à imprimer</h2>
			<div class="panel panel-primary">
				<div class="panel-body text-center">
					<a class="btn btn-success" href="recuReglement.php?ide=<?php echo $ide ?>&tranche=<?php echo $tranche ?>">
						Télecharger le reçu de paiement
					</a>
					<a class="btn btn-success" href="envoyerRecuReglement.php?ide=<?php echo $ide ?>&tranche=<?php echo $tranche ?>">
						Envoyer le reçu de paiement par mail
					</a>
				</div>
			</div>
            <a href="../pages/reglements.php">Retour >>></a>
		</div>
	</body>
</html>