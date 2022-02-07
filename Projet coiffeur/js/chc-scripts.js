 /*
 Author : Maxime Avranche
 Version : v.1.0
*/

// Au chargement
$('formUpdate').ready(function() {



	/* MISE A JOUR DES VALEURS DE L'INDEX */
	// Sélection du formulaire
	$('#clients').click(function(event) { 
		// Désactive le comportement par défaut
		//event.preventDefault();

		// Récupération des valeurs
		var clients = $( "input[name='nbr_clients']" ).val() // On récupère la valeur que l'on souhaite

		// Envoie des données
		var sending = $.post( 'includes/mods.php', { action: 'majClients', nbr_clients: clients } )
			.done(function( data ) {
				$( ".dataJsClients" ).html(clients);
			});

	});

	// Rafraîchir une page avec un btn
	$("button").click(function() {
		location.reload(true);
	});



});	// Fin