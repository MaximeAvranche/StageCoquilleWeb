<?php
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectConfiguration = $db->selectConfiguration();

	 // Variables départ
	 $nbr_employe = $resSelectConfiguration['nbr_employe'];
	 $tps_moyen = $resSelectConfiguration['tps_moyen'];
	 // Conditions
	 if (is_null($nbr_employe)) {
	 	$nbr_employe = "Non défini";
	 }
	 if (is_null($tps_moyen)) {
	 	$tps_moyen = "Non défini";
	 }


	 // Mise à jour de la configuration
	 if (isset($_POST['maj_employe'])) {
	 	$set_value = "nbr_employe = ?";
		$updateValues = $db->updateValues($set_value, $_POST['nbr_employe']);
		header('Location: configuration.php');
	 }

	 if (isset($_POST['maj_temps'])) {
	 	$set_value = "tps_moyen = ?";
		$updateValues = $db->updateValues($set_value, $_POST['tps_attente']);
		header('Location: configuration.php');
	 }

	 if (isset($_POST['maj_add'])) {
		$addName = $db->addName($_POST['name_employe']);
		header('Location: configuration.php');
	 }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Configuration</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<form method="POST" action="">
	<p>
		<h1>Configuration des données</h1>
	</p>

	<center>
		<h3>Employés actuels : <?= $nbr_employe;  ?></h3>
		<h3>Temps moyen estimé : <?= $tps_moyen;  ?> min</h3>
		<p><strong>Phrase d'annonce du temps :</strong> <em>"<?= $resSelectConfiguration['phrase_accroche']; ?> "</em></p>
	</center>
	<div>
		<h2>Général</h2>
		<label>Nombre d'employés</label>
		<input type="number" name="nbr_employe" min="1" value="<?= $resSelectConfiguration['nbr_employe'] ?>" />
		<input type="submit" name="maj_employe" value="Mettre à jour" />
		<br /><br />
		<hr />
		<br /><br />
		<label>Temps moyen</label>
		<input type="number" name="tps_attente" min="0" value="<?= $resSelectConfiguration['tps_moyen'] ?>" />
		<input type="submit" name="maj_temps" value="Changer le temps" />
		<br /><br />
		<hr />
		<br /><br />
		<label>Prénom de l'employé à ajouter</label>
		<input type="text" name="name_employe" placeholder="Saisir un prénom" />
		<input type="submit" name="maj_add" value="Créer l'employé" />
		<br /><br />
		<hr />
	</div>
</form>
</body>
</html>