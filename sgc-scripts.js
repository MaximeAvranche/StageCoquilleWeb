/*
 Author : Maxime Avranche
 Version : v.1.0.0.1 
*/

jQuery(document).ready(function(){

	// Déclarer action déclenchement
	jQuery('.js-btn').click(function( event ){
		// Désactive comportement du clic
		event.preventDefault();

		// Au clique du btn
		var sgc_recup = jQuery(this).attr('id');

		// Teste de recupération
		//alert(sgc_recup);
		// Transforme id en class + recup content
		var sgc_content = jQuery('.' + sgc_recup).html();
		jQuery('.js-content').html(sgc_content);

		// Remonte tous les éléments
		jQuery('.js-content').stop().slideUp('fast', function(){
			// Montre élément choisi
			jQuery('.js-content').stop().slideDown();
		});
		

		
		
		// Affiche le texte en slide down & up
		//jQuery('.js-content').stop().slideToggle();

		// Ajouter une class "active"
		// Slide up des contenus masqués
		//jQuery('.js-content'.not('.active')).slideUp();
	});

});


jQuery(document).ready(function(){
	
});