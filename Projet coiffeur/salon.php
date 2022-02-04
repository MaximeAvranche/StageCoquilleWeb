<?php
	// Appel des fonctions et récupération des données
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectDatabase = $db->selectDatabase();
	 $resSelectConfiguration = $db->selectConfiguration();

	 // Définition des variables
	 $affichage_attente = $resSelectDatabase['tps_attente'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client temps d'attente</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<meta http-equiv="refresh" content="1;URL=salon.php">
<form method="POST" action="" style="margin-top: 35vh;">
	<center><h2 style="font-size: 2.5rem;"><?= $resSelectConfiguration['phrase_accroche'] ?> <?= $affichage_attente; ?></h2></center>
</form>
</body>
</html>