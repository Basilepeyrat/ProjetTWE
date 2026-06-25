
 /* cfg :
 *  type : 'chat' ou 'commentaire'
 *  id : idLeague ou idMatch
 *  monId : id de l'utilisateur connecté
 *  dernierId : id du dernier message déjà affiché par PHP au chargement
 *  boxId : id du conteneur qui reçoit les messages
 *  ormSelector : sélecteur du formulaire d'envoi
 */

//Basile: cette fonction permet d'ajouter les nouveaux messages sans recharger les anciens
function initMessagerie(cfg) {
    //On enregistre le dernier message non lu
	var dernierId = cfg.dernierId;


	function ajouter(m) {
		// on met le message à gauche s'il n'est pas écrit par moi
		var $div = $('<div>').addClass('msg ' + (m.user_id == cfg.monId ? 'msg-moi' : 'msg-autre'));

		//on n'affiche le pseudo que pour les messages écrit par quelqu'un d'autre
		if (m.user_id != cfg.monId) {
			$('<span>').addClass('msg-auteur').text(m.pseudo).appendTo($div);
		}

		$('<span>').addClass('msg-contenu').text(m.contenu).appendTo($div);

		$('#' + cfg.boxId).append($div);
	}
    //Cette fonction sert à récuperer les derniers messages envoyé, après dernierId 
	function verifier() {
		$.getJSON('ajax/lire.php', { type: cfg.type, id: cfg.id, depuis: dernierId }, function (liste) {
			$.each(liste, function (i, m) {
				ajouter(m);
				dernierId = m.id;
			});
			if (liste.length) $('#' + cfg.boxId).scrollTop($('#' + cfg.boxId)[0].scrollHeight);
		});
	}

	$(cfg.formSelector).on('submit', function (e) {
		e.preventDefault();

		var texte = $('input[name="contenu"]', this).val().trim();
		if (!texte) return;

		$.post('ajax/envoyer.php', { type: cfg.type, id: cfg.id, contenu: texte }, function () {
			$('input[name="contenu"]', cfg.formSelector).val('');
			verifier();
		});
	});

	setInterval(verifier, 3000);
	$box.scrollTop($box[0].scrollHeight);
    $('#' + cfg.boxId).scrollTop($('#' + cfg.boxId)[0].scrollHeight);
}