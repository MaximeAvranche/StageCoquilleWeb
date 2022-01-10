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




/**
  * Message "Try it"
**/
	// Cible le input en question
	jQuery('input').focus(function(){
		// Le prochain span (suivant l'input) va apparaître durant un délais défini et prendre les paramètres css
		jQuery(this).next('span').css('display', 'inline').fadeOut(1500);
	});



/**
  * Message quand la saisie est en cours
**/
// Page chargée

	// Lorsque l'utilisateur saisi l'input, le message s'affichera
	jQuery('.sgc-answer').keyup(function(){
		// Value à récupérer
		var sgc_txt_saisi = "Test123";
		if(jQuery('#sgc-answer-id').val() == jQuery(sgc_txt_saisi).val()) {
				alert("Correspond");
			}
		// Afficher après le champs input un texte qui apparaît
		jQuery(this).next().html("<span class='sgc-pop-try'>Essaies encore pour voir...</div>").fadeIn();

	});


/**
  * Cases à cocher
**/
// Quand cliqué
jQuery(document).click(function(){
	// On vérifie si la bonne réponse (définie ici) est 'checked'
	if(jQuery('input[name=merci]').is(':checked')) {
		// Affichage d'un message félicitant l'utilisateur + PASSER A L'AUTRE QUESTION
		jQuery('.sgc-q2-error').stop().slideUp();
		jQuery('#sgc-quizz-q3').css('display', 'inline').slideDown();
	}
	else {
		// Message indiquant qu'il ne s'agit pas de la bonne réponse
		jQuery('.sgc-q2-error').text("Mauvaise réponse ! Tu as de la chance, je suis de bonne humeur, tu peux retenter ta chance.").stop().slideDown();
		jQuery('#sgc-quizz-q3').fadeOut(0.1);
	}
});


/**
  * Bouton "Devenir riche"
**/

	jQuery('#joke').click(function(){
		// Désactive comportement du clic
		event.preventDefault();
		// Animation du btn
		jQuery('.sgc-btn-quizz').animate({"marginLeft": "+=250px", "marginTop": "+=50px"}, "fast");
	});

	
});