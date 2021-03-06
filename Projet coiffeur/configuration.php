<?php
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectConfiguration = $db->selectConfiguration();
	 $resSelectInformation = $db->selectInformation();
	 $resCountEmployee = $db->countEmployee();

	 // Variables départ
	 $tps_moyen = $resSelectConfiguration['tps_moyen'];
	 $nbr_employe_total = $resCountEmployee['id'] - 1;

	 // Conditions
	 if (is_null($nbr_employe_total)) {
	 	$nbr_employe = "Non défini";
	 }
	 if (is_null($tps_moyen)) {
	 	$tps_moyen = "Non défini";
	 }

	 // Message configuration - BVN
	 if ($resCountEmployee['id'] == 1) {
	 	$message_bienvenue = "<p style='margin: 50px 0px 75px 50px;'>Bienvenue dans votre interface de configuration. <br />Ici, vous pourrez ajouter des employés, modifier le temps d'attente moyen ou encore modifier la phrase d'accroche du temps d'attente.<br />Par défaut, certaines valeurs ont été configurées. Modifiez-les à votre guise.</p>";
	 	$message_employe = "<p style='margin: 10px 0px 40px 25px;'>Oh, je vois que vous n'avez pas d'employé configuré. Remédions ensemble à cela. <br /> Il vous suffit d'ajouter le nom de votre premier employé afin de le créer et de l'ajouter à votre liste.</p>";
	 }
	 else {
	 	$message_employe = null;
	 	$message_bienvenue = null;
	 }

	 // Mise à jour de la configuration
	 /*if (isset($_POST['maj_employe'])) {
	 	$set_value = "nbr_employe = ?";
		$updateValues = $db->updateValues($set_value, $_POST['nbr_employe']);
		header('Location: configuration.php');
	 }*/

	 if (isset($_POST['maj_temps'])) {
	 	$set_value = "tps_moyen = ?";
		$updateValues = $db->updateValues($set_value, $_POST['tps_attente']);
		header('Location: configuration.php');
	 }

	 if (isset($_POST['maj_add'])) {
		$addName = $db->addName($_POST['name_employe']);
		header('Location: configuration.php');
	 }

	  // Supprimer un employe
	 if (isset($_GET['action'])) {
	 $actionName = htmlspecialchars($_GET['action']);
		 if ($actionName == "DeleteEmploye") {
		 	$id_employe = htmlspecialchars($_GET['id']);
		 	$db->deleteEmploye($id_employe);
		 	header('Location: configuration.php');
		 }
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
		<h1>Configuration des données</h1>
		<?= $message_bienvenue; ?>

	<center>
		<h3>Employé(s) configuré(s): <?= $nbr_employe_total;  ?></h3>
		<h3>Temps moyen estimé fixé à <?= $tps_moyen;  ?> min</h3>
		<p><strong>Phrase d'annonce du temps :</strong> <em>"<?= $resSelectConfiguration['phrase_accroche']; ?> "</em></p>
	</center>
	<div>
		<h2>Général</h2>
		<?= $message_employe; ?>
		<p>Nombre d'employé(s) : <strong><?= $nbr_employe_total;  ?></strong></p>
		<br />
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

	<div style="display: flex">
		<?php foreach ($resSelectInformation as $infos) {?>
		<p><?= $infos['nom_employe']; ?></p>
		<a href="configuration.php?action=DeleteEmploye&amp;id=<?= $infos['id'] ?>">Supprimer</a>

	<?php } ?>
</form>
</body>
</html>