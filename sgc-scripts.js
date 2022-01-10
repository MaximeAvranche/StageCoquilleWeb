/*
 Author : Maxime Avranche
 Version : v.1.0.0.1 
*/

jQuery(document).ready(function(){

	// Déclarer action déclenchement
	jQuery('.js-btn').click(function(event) {
		// Désactive comportement du clic
		event.preventDefault();
		// Au clique du btn
		var sgc_recup = jQuery(this).attr('id');
		// Teste de recupération
		//alert(sgc_recup);
		// Transforme id en class + recup content
		var sgc_content = jQuery('.' + sgc_recup).html();
		jQuery('.js-content').html(sgc_content);

	});

});