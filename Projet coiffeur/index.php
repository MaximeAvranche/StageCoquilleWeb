<?php
	// Appel des fonctions et récupération des données
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectDatabase = $db->selectDatabase();
	 $resSelectConfiguration = $db->selectConfiguration();
	 // Définition des variables
	 $employe_total = $resSelectDatabase['nbr_disponible'] + $resSelectDatabase['nbr_occupe'];
	 $employe_total = 1 / $employe_total;
	 $clients = $resSelectDatabase['nbr_clients'];

	 // Prise en charge d'un client
	 $new_disponible = $resSelectDatabase['nbr_disponible'] - 1;
	 $new_clients = $resSelectDatabase['nbr_clients'] - 1;
	 // Mise à jour d'un créneau
	 $new_occupe = $resSelectDatabase['nbr_occupe'] + 1;
	 $new_attente = $resSelectDatabase['tps_attente'] + 30;
	 // Libération d'un employé
	 $employeOccupe = $resSelectDatabase['nbr_occupe'];
	 $clcDisponible = $resSelectDatabase['nbr_disponible'] + 1;
	 $clcOccupe = $resSelectDatabase['nbr_occupe'] - 1;


	 // Réinitialiser valeurs de tests
	 if(isset($_POST['reinitialiser'])) {
	 	$updateCreneau = $db->updateCreneau($resSelectConfiguration['nbr_employe'], 0, 0, 3);
	 	header('Location: index.php');
	 }

	 // Mettre à jour le nombre de clients
	 if (isset($_POST['maj'])) {
	 	$maj = $db->addCustomer($_POST['nbr_clients']);
	 	header('Location: index.php');
	 }

	 // Prise en charge d'un client
	 if (isset($_POST['prisencharge'])) {
	 	// Bloquer les valeurs négatives
		 if ($resSelectDatabase['nbr_clients'] == 0 OR $resSelectDatabase['nbr_disponible'] == 0) {
		 	header('Location: index.php');	
		 }
		 else {
		 	// Employés supérieurs aux clients
		 	if ($resSelectDatabase['nbr_disponible'] >= $resSelectDatabase['nbr_client']) {
		 		$new_occupe = $resSelectDatabase['nbr_occupe'] + 1;
		 		$updateCreneau = $db->updateCreneau($new_disponible, $new_occupe, $resSelectDatabase['tps_attente'], $new_clients);
		 		header('Location: index.php');
		 	}
		 	// Employés inférieurs aux clients
		 	else if ($resSelectDatabase['nbr_disponible'] < $resSelectDatabase['nbr_client']) {
			 	$updateCreneau = $db->updateCreneau($new_disponible, $new_attente, $new_clients);
			 	header('Location: index.php');
		 	}
	 	}
	 }

	 // Prestation terminée
	 if (isset($_POST['terminee'])) {
	 		// Bloquer les valeurs négatives
	 		if ($resSelectDatabase['nbr_occupe'] == 0) {
	 			header('Location: index.php');
	 		}
		 		else {
		 			$addEmploye = $db->addEmploye($clcDisponible, $clcOccupe);
			 		header('Location: index.php');
		 		}
	 }

	 // Calcul temps d'attente
	 if ($resSelectDatabase['nbr_clients'] <= $resSelectDatabase['nbr_disponible']) {
	 	$temps_attente = 0;
	 }
	 // Les employés ne sont pas disponibles - Des clients attendent
	 else {
	 	$temps_attente = ((30 * $clients) - ($employe_total * 30)) + (30 * $employe_total);
	 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<form method="POST" action="">
	<p>
		<h2>Configuration</h2>
		<legend>Nombre de clients</legend>
		<input type="number" name="nbr_clients" value="<?= $resSelectDatabase['nbr_clients'] ?>" />
		<br />
		<input type="submit" name="maj" />
	</p>

	<center><h2>Employés disponibles : <?= $resSelectDatabase['nbr_disponible'];  ?></h2></center>
	<center><h2>Temps d'attente : <?= $temps_attente; ?></h2></center>
	<center><h3>Clients en attente : <?= $resSelectDatabase['nbr_clients']; ?></h3></center>

	<div align="center">
		<table style="margin-top: 100px; text-align: center;">
			  <tr>
			    <th>Maxime</th>
			    <th>Steven</th>
			  </tr>
			  <tr>
			    <td><input type="submit" name="prisencharge" value="Je prends en charge un client" /></td>
			    <td><input type="submit" name="prisencharge" value="Je prends en charge un client" /></td>
			  </tr>
			  <tr>
			    <td><input type="submit" name="terminee" value="Prestation terminée" /></td>
			    <td><input type="submit" name="terminee" value="Prestation terminée" /></td>
			  </tr>
		</table>
	</div>
	<input type="submit" name="reinitialiser" value="Réinitialiser les valeurs">
</form>
<?php
$temps = 160;
     if ($temps > 59) {
     	$coef_heure = $temps / 60;
     	$heure = floor($temps / 60);
     	$minute = ($coef_heure * 60);
     	echo $heure ."h ". $minute . "min";
     }
     else {
     	echo $temps;
     }
?>
</body>
</html>