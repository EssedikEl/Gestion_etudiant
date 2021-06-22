<?php

	if(isset($_GET['ide']))
		$ide=$_GET['ide'];
	else
		$ide=0;

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
					<a class="btn btn-success" href="attestationScolarite.php?ide=<?php echo $ide ?>">
						Attestation de scolarité
					</a>
				</div>
			</div>
            <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retour >>></a>
		</div>
	</body>
</html>