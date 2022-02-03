<?php
	include 'includes/functions.php';
	 $db = new ConnexionBase;
	 $resSelectDatabase = $db->selectDatabase();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="POST" action="">
	<p>
		<h1>Configuration des données</h1>
	</p>

	<center>
		<h3>Employés actuels : <?= $resSelectDatabase['nbr_disponible'];  ?></h3>
		<h3>Temps moyen estimé : <?= $resSelectDatabase['nbr_disponible'];  ?></h3>
	</center>
	<div>
		<h2>Général</h2>
		<legend>Nombre de clients</legend>
		<input type="number" name="nbr_clients" value="<?= $resSelectDatabase['nbr_clients'] ?>" />
		<br /><br />


		<input type="submit" name="maj" />
	</div>
</form>
</body>
</html>