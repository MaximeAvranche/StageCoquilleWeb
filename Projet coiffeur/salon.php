<?php
	// Appel des fonctions et récupération des données
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectDatabase = $db->selectDatabase();
	 $resSelectConfiguration = $db->selectConfiguration();
	 $resCountEmployee = $db->countEmployee();

	 // Définition des variables
	 $affichage_attente = $resSelectDatabase['tps_attente'];
	 $employe_total = $resSelectDatabase['nbr_disponible'] + $resSelectDatabase['nbr_occupe'];
	 $employe_total = 1 / $employe_total;
	 $clients = $resSelectDatabase['nbr_clients'];
	 $temps_moyen = $resSelectConfiguration['tps_moyen'];

	 // Message configuration - BVN
	 if ($resCountEmployee['id'] == 1) {
	 	$affichage_attente = "<a href='configuration.php' style='text-decoration: none; color: red'>Non configuré</a>";
	 }
	 else {
	 	// Fonctions
		 if ($affichage_attente == 0) {
		 	$affichage_attente = "Prise en charge instantanée";
		 }
		 else {
		 	$temps = (($temps_moyen * $clients) - ($employe_total * $temps_moyen)) + ($temps_moyen * $employe_total);
			$affichage_attente = $db->waitingTime($temps);
		}
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