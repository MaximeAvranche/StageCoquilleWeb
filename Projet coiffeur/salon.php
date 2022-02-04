<?php
	// Appel des fonctions et récupération des données
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectDatabase = $db->selectDatabase();
	 $resSelectConfiguration = $db->selectConfiguration();

	 // Définition des variables
	 $affichage_attente = $resSelectDatabase['tps_attente'];
	 if ($affichage_attente == 0) {
	 	$affichage_attente = "Prise en charge instantanée";
	 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Client temps d'attente</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<style>
	body {
		background-image: url('https://us.123rf.com/450wm/9dreamstudio/9dreamstudio1802/9dreamstudio180200726/94963909-%C3%A9quipement-de-salon-de-beaut%C3%A9-coiffure-et-coupe-de-cheveux-peignes-sciccors-brosses-sur-la-vue-de-de.jpg?ver=6');
		background-repeat: no-repeat;
		background-size: cover;
		color: #474747;
	}
	</style>
	<meta http-equiv="refresh" content="1;URL=salon.php">
<form method="POST" action="" style="margin-top: 30vh;">
	<center><h2 style="font-size: 4.5rem;"><?= $resSelectConfiguration['phrase_accroche'] ?> </h2>
		<h2><span style="font-size: 6.5rem; color: #1E1E1E"><?= $affichage_attente; ?></span></h2></center>
</form>
</body>
</html>