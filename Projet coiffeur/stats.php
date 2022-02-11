<?php
	include 'includes/mods.php';
	// Variables
	$resSelectStats = $db->selectStats($chosedate);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Statistiques</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h2>Statistiques</h2>
<h4>Choix d'une date</h4>
<form method="POST" action="">
	<input type="date" name="choixdate" />
	<input type="submit" name="chosedate" value="Choisir la date" />
</form>
<h3>Statistiques du <span><?= $chosedate; ?></span></h3>
<div>
	<p>Nombre d'employés <span class="stats"><?= $employes; ?></span></p>
	<p>Total clients traités <span class="stats"><?= $total_clients_traites; ?></span></p>
	<p>Total clients au salon<span class="stats"><?= $total_clients; ?></span></p>
	<p>Résultat : <span class="<?= $variation; ?>"><?= $value; ?></span></p>
</div>
</body>
</html>