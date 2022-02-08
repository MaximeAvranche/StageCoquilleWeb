<?php
	include 'includes/mods.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion</title>
	<script src="js/jquery-3-6-0.min.js"></script>
	<script src="js/chc-scripts.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<form method="POST" action="" id="formUpdate">
	<p>
		<h2>Configuration</h2>
		<label>Nombre de clients</label>
		<input type="number" name="nbr_clients" id="clients" min="0" value="<?= $resSelectDatabase['nbr_clients'] ?>" />
		<input type="submit" name="maj" id="maj" />
	</p>

	<center><h2>Employé(s) disponible(s) : <?= $resSelectDatabase['nbr_disponible'];  ?></h2></center>
	<center><h2>Temps d'attente : <?= $affichage_attente; ?></h2></center>
	<center><h3>Client(s) en attente : <span class="dataJsClients"><?= $resSelectDatabase['nbr_clients']; ?></span></h3></center>
	<div style="display: flex">
		<?php foreach ($resSelectInformation as $infos) {?>
			<p><?= $infos['nom_employe']; ?></p>
			<input type="submit" name="prisencharge" value="Je prends en charge un client" />
			<input type="submit" name="terminee" value="Prestation terminée" />
		<?php } ?>
	</div>
	<br /><br />
	<input type="submit" name="reinitialiser" value="Réinitialiser les valeurs" />

	<br /><br /><br /><br /><br /><br />
	<input type="submit" name="break" value="Je prends une pause" />

	<center><button type="button">Refresh</button></center>




	<a onclick="openNewTab();">app2</a>

	<a onclick="refreshNewTab();">Refresh</a>
	<script>
		var childWindow = "";
		var openTab ="salon.php";

		function openNewTab(){
	        childWindow = window.open(openTab);
	    }	    
	</script>
</form>
</body>
</html>